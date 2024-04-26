<?php
/**
 * FluentRequest.php
 */

namespace GettyImages\Api\Request {
    use GettyImages\Api\Exception;
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
         * Holds the data for body in request
         * @access private
         */
        protected $data;

        /**
         * Holds the credentials object
         * @access private
         */
        protected $credentials = null;

        protected $options = array();

        /**
         * The root endpoint for Connect
         * @access private
         */
        protected $endpointUri = null;

        protected $container;

        /**
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
            $this->options[CURLOPT_HTTPHEADER] = array();
        }

        /**
         * @param string $field The array field in request details to append the value to
         * @param array $values The values to add
         * @throws \Exception If values is not an array an exception is thrown
         */
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

        protected function addHeader(string $name, string $value) {
            $this->options[CURLOPT_HTTPHEADER][] = $name.": ".$value;
        }

        /**
         * Perform the request against the api
         */
        public function execute() {
            $route = $this->getRoute();
            if ($route === null)
            {
                throw new \Exception("No appropriate route found for this request.");
            }
            $endpointUrl = $this->endpointUri."/".$route;
            $method = $this->getMethod();
            
            $this->options[CURLOPT_HTTPHEADER][] = "Api-Key:".$this->credentials->getApiKey();
            $this->options[CURLOPT_HTTPHEADER][] = "Authorization: ".$this->credentials->getAuthorizationHeaderValue();

            $webHelper = new WebHelper($this->container);
            
            switch ($method) {
                case "get":
                    $response = $webHelper->get($endpointUrl,
                                                $this->requestDetails,
                                                $this->options);
                    break;
                case "post":
                    $response = $webHelper->post($endpointUrl,
                                                $this->requestDetails,
                                                $this->options,
                                                $this->data);
                    break;
                case "put":
                    $response = $webHelper->put($endpointUrl,
                                            $this->requestDetails,
                                            $this->options,
                                            $this->data);
                    break;
                case "delete":
                    $response = $webHelper->delete($endpointUrl,
                                            $this->requestDetails,
                                            $this->options);
                    break;
                default:
                    throw new \Exception("No appropriate HTTP method found for this request.");
            }

            return $this->handleResponse($response);
        }

        /**
         * Upload image for SBI search
         */
        protected function executeFileUpload(string $route, string $filepath) {
            $endpointUrl = $this->endpointUri."/".$route;

            $this->options[CURLOPT_HTTPHEADER][] = "Api-Key:".$this->credentials->getApiKey();

            $webHelper = new WebHelper($this->container);

            $response = $webHelper->putImageRequest($endpointUrl,
                $this->requestDetails,
                $filepath,
                $this->options
            );

            return $this->handleResponse($response);
        }

        protected function handleResponse($response){
            if(($response["http_code"] < 200 || $response["http_code"] >= 300) && $response['http_code'] != 303) {
                $body = json_decode($response["body"], true);
                throw new Exception\ClientException($body["ErrorMessage"], $response["http_code"], $body["ErrorCode"]);
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
         * @param string $name The name of the custom header
         * @param string $value The value to set for the custom header
         */
        public function withCustomHeader(string $name, string $value) {
            $this->addHeader($name, $value);
            return $this;
        }

        /**
         * @param string $name The name of the custom parameter
         * @param string $value The value to set for the custom parameter
         */
        public function withCustomParameter(string $name, string $value) {
            $this->requestDetails[$name] = $value;
            return $this;
        }

        
        /**
         * @return string
         */
        abstract protected function getRoute();
    }
}
