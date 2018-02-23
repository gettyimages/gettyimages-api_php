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

        protected $authHeader;

        /**
         * The root endpoint for Connect
         * @access private
         */
        protected $endpointUri = null;

        protected $container;

        /**
         *
         * @param mixed $credentials
         * @param string $endpointUri
         * @param mixed $container
         * @param string[] $requestParams Optional search request details if you already know what you want.
         */
        public function __construct(&$credentials, $endpointUri, $container, array $requestParams = null) {
            $this->credentials = $credentials;

            $this->endpointUri = $endpointUri;
            if(!is_null($requestParams)) {
                $this->requestDetails = $requestParams;
            }

            $this->container = $container;
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

        protected function addArrayOfValuesToRequestDetails($field,$values) {
            if(!is_array($values)) {
                throw new \Exception("Values " . $values . " is not an array");
            }
            if(strpos($field, 'id') === false ) {
                $values = array_map('strtolower', $values);
            }
            if(!array_key_exists($field,$this->requestDetails) || is_null($this->requestDetails[$field])) {
                $this->requestDetails[$field] = $values;
            }
            else { 
                $this->requestDetails[$field] = array_unique(array_merge($this->requestDetails[$field], $values));
            }
        }

        /**
         * Perform the request against the api
         */
        public function execute() {
            $endpointUrl = $this->endpointUri."/".$this->getRoute();
            $method = $this->getMethod();

            if (!$this->authHeader)
            {
                $this->authHeader = array(CURLOPT_HTTPHEADER => array("Api-Key:".$this->credentials->getApiKey(),
                                        "Authorization: ".$this->credentials->getAuthorizationHeaderValue()));
            }

            $webHelper = new WebHelper($this->container);
            
            switch ($method) {
                case "get":
                    $response = $webHelper->get($endpointUrl,
                                                $this->requestDetails,
                                                $this->authHeader);
                    break;
                case "post":
                    $response = $webHelper->postWithNoBody($endpointUrl,
                                                $this->requestDetails,
                                                $this->authHeader);
                    break;
                default:
                    throw new \Exception("No appropriate HTTP method found for this request.");
            }
            
            return $this->handleResponse($response);
        }

        protected function handleResponse($response){
            if($response["http_code"] != 200 && $response['http_code'] != 303) {
                throw new \Exception("Non 200 status code returned: " .$response["http_code"] . "\nBody: ". $response["body"]);
            }

            if($response["http_code"] == 303) {
                $parsedHeaderArray = explode("\r\n", $response["header"]);
                foreach ($parsedHeaderArray as $headerValue) {
                    $headerValueToLookup = "Location: ";
                    $headerLookupLen = strlen($headerValueToLookup);

                    if(substr($headerValue, 0, $headerLookupLen) === $headerValueToLookup) {
                        $imageDownloadUrl = substr($headerValue, $headerLookupLen);
                        return $imageDownloadUrl;
                    }
                }
            } 

            return $response["body"];
        }

        
        /**
         * @return string
         */
        abstract protected function getRoute();
    }
}