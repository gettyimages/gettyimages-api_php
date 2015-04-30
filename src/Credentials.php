<?php

namespace GettyImages\Api {

    use GettyImages\Api\Exception\CredentialValidationException;
    use GettyImages\Api\Exception\UnknownCredentialTypeException;
    use GettyImages\Api\Request\Oauth2;
    use GettyImages\Api\Request\WebHelper;

    /**
     *  Provides token management for the GettyImages API SDK.
     *
     */
    class Credentials {
        /**
         * @access private
         */
        private $credentials = array();


        /**
         * @access private
         */
        private $tokenDetails = array();

        /**
         * @access private
         */
        private $endpointUri = null;

        /**
         * Creates an instance of your GettyImages credentials either through explicitly setting of them or
         * implicitly pulling them from the environment.
         *
         * @param string $endpointUri The uri where the oauth2 endpoint is.
         * @param string[] $credentials Optionally provide explicit credentials to use. If not provided will get setting from the environment
         */
        public function __construct($endpointUri, array $credentials) {
            $this->endpointUri = $endpointUri;
            $credentials = $this->removeNullValuesFromArray($credentials);
            $this->credentials = self::validateCredentials($credentials);
        }

        private function removeNullValuesFromArray(array $collectionToFilter) {
            $output = array();

            foreach($collectionToFilter as $key => $value) {
                if(is_null($value)) {
                    continue;
                }

                $output[$key] = $value;
            }

            return $output;
        }

        /**
         * @access private
         */
        private static function validateCredentials($credentials) {
            if($credentials == null) {
                throw new CredentialValidationException("Credentials were null");
            }

            if(array_key_exists("client_key",$credentials) && !is_null($credentials["client_key"])) {
                $credentials["credential_type"] = "api-key";
            }

            if(array_key_exists("client_secret",$credentials) && !is_null($credentials["client_secret"])) {
                $credentials["credential_type"] = "client_credentials";
            }

            if(array_key_exists("refresh_token",$credentials)) {
                $credentials["credential_type"] = "resource_owner";
            }

            if(array_key_exists("username",$credentials) &&
                array_key_exists("password",$credentials) &&
                !is_null($credentials["username"]) &&
                !is_null($credentials["password"])) {
                $credentials["credential_type"] = "resource_owner";
            }

            if(!array_key_exists("credential_type",$credentials)) {
                throw new CredentialValidationException("Credentials could not be determined");
            }

            return $credentials;
        }

        /**
         * Returns the api key for the configured credentials
         *
         * @return string
         */
        public function getApiKey() {

            if(array_key_exists("client_key", $this->credentials)) {
                return $this->credentials["client_key"];
            }

            return false;
        }

        /**
         * Returns the Authorization token string
         *
         * The string will be emitted as token_type access_token
         * Ex: Bearer ....
         *
         * @return string
         */
        public function getAuthorizationHeaderValue() {

            if($this->credentials["credential_type"] === "api-key") {
                return false;
            }

            $details = $this->getAuthenticationDetails();
            return $details["token_type"]." ".$details["access_token"];
        }

        /**
         * Calculates if the token has expired based on it's expires_in setting
         *
         * @access private
         */
        private function tokenHasExpired() {
            if($this->tokenDetails != null &&
                array_key_exists("sdk_expire_time",$this->tokenDetails)) {
                return time() > $this->tokenDetails["sdk_expire_time"];
            }

            return true;
        }

        /**
         * Gives back the underlying credential array
         *
         * Note: This is a cached operation. The system will check the expiration time of the token.
         * If it has expired, then it will renew it before returning the object.
         *
         * @throws UnknownCredentialTypeException
         * @throws \Exception
         * @return mixed[]
         */
        public function getAuthenticationDetails() {
            if(!$this->tokenHasExpired()) {
                return $this->tokenDetails;
            }

            $credentialType = $this->credentials["credential_type"];

            switch ($credentialType) {
                case "client_credentials":  
                    $response = $this->getOauth2ClientCredentials($this->credentials["client_key"],$this->credentials["client_secret"]);
                    break;
                case "resource_owner":
                    if(array_key_exists("refresh_token",$this->credentials)) {

                       $response = $this->getOauth2ResourceOwnerCredentialsWithRefreshToken($this->credentials["client_key"],
                                                                                           $this->credentials["client_secret"],
                                                                                           $this->credentials["refresh_token"]);
                    } else {

                        $response = $this->getOauth2ResourceOwnerCredentials($this->credentials["client_key"],
                                                                             $this->credentials["client_secret"],
                                                                             $this->credentials["username"],
                                                                             $this->credentials["password"]);
                    }
                    break;
                default:
                    throw new UnknownCredentialTypeException("Not sure what type : ".$credentialType);
            }

            if($response["http_code"] != 200) {
                throw new \Exception("Non 200 status code: ".$response["http_code"]."\nCurlError: ".$response["curl_error"]."\nResponse Body: ".$response["body"]."\nHeaders: ".$response["header"]."\n".$response["last_url"]."\nAdditional DebugInfo: ".$response["debugInfo"]);
            }

            $this->tokenDetails = json_decode($response["body"],true);

            $this->tokenDetails["sdk_expire_time"] = time() + $this->tokenDetails["expires_in"];

            return $this->tokenDetails;
        }

        /**
         * Handles getting a Resource Owner credential response
         *
         * @param string $userKey Mashery API Key
         * @param string $userSecret Mashery API Secret
         * @param string $userName Getty Images Username
         * @param string $userPassword Getty Images password
         * @return string Full oauth2 response object in json format
         */
        public function getOauth2ResourceOwnerCredentials($userKey, $userSecret, $userName, $userPassword) {

            $request = array(
                "client_id" => $userKey,
                "client_secret" => $userSecret,
                "username" => $userName,
                "password" => $userPassword,
                "grant_type" => "password"
            );

            $response = WebHelper::postFormEncodedWebRequest($this->endpointUri,$request);

            return $response;
        }

        public function getOauth2ResourceOwnerCredentialsWithRefreshToken($userKey, $userSecret, $refreshToken) {
            $request = array(
                "client_id" => $userKey,
                "client_secret" => $userSecret,
                "refresh_token" => $refreshToken,
                "grant_type" => "refresh_token");

            $response = WebHelper::postFormEncodedWebRequest($this->endpointUri, $request);
            return $response;
        }

        /**
         * Handles getting a client credential response
         *
         * @param string $userKey Mashery API Key
         * @param string $userSecret Mashery API Secret
         * @return string Full oauth2 response object in json format
         */
        public function getOauth2ClientCredentials($userKey, $userSecret) {
            $request = array(
                "client_id" => $userKey,
                "client_secret" => $userSecret,
                "grant_type" => "client_credentials"
            );

            $response = WebHelper::postFormEncodedWebRequest($this->endpointUri,$request);

            return $response;
        }
    }

}
