<?php
/**
 * FluentRequest.php
 */

namespace GettyImages\Api\Request {

    /**
     * FluentRequest
     *
     * Provides the base functionality for the fluent interface. This abstract class provides
     * All operations against the api must derive from FluentRequest
     */
    abstract class FluentRequest {
        /**
         * Request property bag
         * @access private
         */
        public $requestDetails = array();

        /**
         * Holds the credentials object
         * @access private
         */
        protected $credentials = null;

        /**
         * The root endpoint for Connect
         * @access private
         */
        protected $endpointUri = null;

        /**
         *
         * @param mixed $credentials
         * @param string $endpointUri
         * @param string[] $requestParams Optional search request details if you already know what you want.
         */
        public function __construct(&$credentials, $endpointUri, array $requestParams = null) {
            $this->credentials = $credentials;

            $this->endpointUri = $endpointUri;
            if(!is_null($requestParams)) {
                $this->requestDetails = $requestParams;
            }
        }

        /**
         * @param string $field The array field in request details to append the value to
         * @param string $value The value to push
         * @throws \Exception If the request details field is already initialized and is not an array
         */
        protected function appendArrayValueToRequestDetails($field,$value) {
            if(!array_key_exists($field,$this->requestDetails) || is_null($this->requestDetails[$field])) {
                $this->requestDetails[$field] = array();
            }

            if(!is_array($this->requestDetails[$field])) {
                throw new \Exception("Request field " . $field . " is not an array");
            }

            array_push($this->requestDetails[$field],strtolower($value));
        }

        /**
         * Perform the request against the api
         */
        public function execute() {
            $endpointUrl = $this->endpointUri."/".$this->getRoute();

            $response = WebHelper::getJsonWebRequest($endpointUrl,
                $this->requestDetails,
                array(CURLOPT_HTTPHEADER => array("Api-Key:".$this->credentials->getApiKey(),
                    "Authorization: ".$this->credentials->getAuthorizationHeaderValue())));

            if($response["http_code"] != 200) {
                throw new \Exception("Non 200 status code returned: " .$response["http_code"] . "\nBody: ". $response["body"]);
            }

            return $response["body"];
        }

        /**
         * @return string
         */
        abstract protected function getRoute();
    }
}