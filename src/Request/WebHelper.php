<?php

/**
 * Provides general helpers around curl
 */

namespace GettyImages\Api\Request {

    /**
     * @ignore
     */
    class WebHelper {
        protected $container;

        /**
         * @param mixed $container
         */
        public function __construct($container) {
            $this->container = $container;
        }

        public function postFormEncodedWebRequest($endpoint,array $data, array $options = array()) {

            $data = http_build_query($data);
            $defaults = array(
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Content-Length: ' . strlen($data)),
                CURLOPT_POST => 1,
            );

            $defaults[CURLOPT_URL] = $endpoint;
            $defaults[CURLOPT_POSTFIELDS] = $data;

            $result = $this->execute(($options + $defaults));

            return $result;
        }

        /**
         * Send a POST requst using cURL
         * @param string $url to request
         * @param array $queryParams values to send
         * @param array $options for cURL
         * @param array $data to add to body
         * @return string
         */
        public function post($endpoint, $queryParams, array $options = array(), array $data = null) {

            $endpoint = $endpoint. (strpos($endpoint, '?') === FALSE ? '?' : ''). self::BuildQueryParams($queryParams);

            if(!array_key_exists(CURLOPT_HTTPHEADER, $options)) {
                $options[CURLOPT_HTTPHEADER] = array();
            }

            $data = json_encode($data);

            array_push($options[CURLOPT_HTTPHEADER],'Content-Type: application/json');
            array_push($options[CURLOPT_HTTPHEADER], 'Content-Length: ' . strlen($data));
            $options[CURLOPT_POST] = 1;
            $options[CURLOPT_POSTFIELDS] = $data;
            $options[CURLOPT_URL] = $endpoint;

            $result = self::execute($options);
            return $result;
        }

         /**
         * Send a PUT requst using cURL
         * @param string $url to request
         * @param array $queryParams values to send
         * @param array $options for cURL
         * @param array $data to add to body
         * @return string
         */
        public function put($endpoint, $queryParams, array $options = array(), array $data = null) {

            $endpoint = $endpoint. (strpos($endpoint, '?') === FALSE ? '?' : ''). self::BuildQueryParams($queryParams);

            if(!array_key_exists(CURLOPT_HTTPHEADER, $options)) {
                $options[CURLOPT_HTTPHEADER] = array();
            }

            $data = json_encode($data);

            array_push($options[CURLOPT_HTTPHEADER],'Content-Type: application/json');
            array_push($options[CURLOPT_HTTPHEADER], 'Content-Length: ' . strlen($data));
            $options[CURLOPT_CUSTOMREQUEST] = 'PUT';
            $options[CURLOPT_POSTFIELDS] = $data;
            $options[CURLOPT_URL] = $endpoint;

            $result = self::execute($options);
            return $result;
        }

        /**
         * Send a PUT requst using cURL
         * @param string $url to request
         * @param array $queryParams values to send
         * @param array $options for cURL
         * @param string $filepath of image to add
         * @return string
         */
        public function putImageRequest($endpoint, $queryParams, array $options = array(), string $filepath) {

            $image = fopen($filepath, "rb");

            if(!array_key_exists(CURLOPT_HTTPHEADER, $options)) {
                $options[CURLOPT_HTTPHEADER] = array();
            }

            array_push($options[CURLOPT_HTTPHEADER],'Content-Type: image/jpeg');
            $options[CURLOPT_PUT] = 1;
            $options[CURLOPT_INFILE] = $image;
            $options[CURLOPT_INFILESIZE] = filesize($filepath);
            $options[CURLOPT_URL] = $endpoint;
            $result = self::execute($options);

            return $result;
        }


        /**
         * Send a GET requst using cURL
         * @param string $url to request
         * @param array $requestParams values to send
         * @param array $options for cURL
         * @return string
         */
        public function get($url, array $requestParams = NULL, array $options = array()) {
            $url = $url. (strpos($url, '?') === FALSE ? '?' : ''). self::BuildQueryParams($requestParams);
            $options[CURLOPT_URL] = $url;

            $result = $this->execute($options);

            return $result;
        }

        /**
         * Send a DELETE requst using cURL
         * @param string $url to request
         * @param array $requestParams values to send
         * @param array $options for cURL
         * @return string
         */
        public function delete($url, array $requestParams = NULL, array $options = array()) {
            $url = $url. (strpos($url, '?') === FALSE ? '?' : ''). self::BuildQueryParams($requestParams);
            $options[CURLOPT_URL] = $url;
            $options[CURLOPT_CUSTOMREQUEST] = "DELETE";

            $result = $this->execute($options);

            return $result;
        }

        private static function BuildQueryParams(array $params) {
            $queryParams = array();

            foreach($params as $key => $value) {
                if(is_array($value)) {
                    $queryParams[$key] = implode(",", $value);
                } else
                {
                    $queryParams[$key] = $value;
                }
            }

            return http_build_query($queryParams);
        }

        /**
         * @ignore
         */
        private static function getCurlDefaults($options) {

            $userAgent = "GettyImagesApiSdk/2.0.0 (". php_uname("s")." ".php_uname("r")."; PHP ". phpversion() . ")";

            $defaults = array(
                CURLOPT_HEADER => 1,
                CURLOPT_FRESH_CONNECT => 1,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_FORBID_REUSE => 1,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_SSL_VERIFYPEER => 1,
                CURLOPT_USERAGENT => $userAgent
            );

            if(getenv("GettyImagesApi_UseProxy") != null) {
                $defaults[CURLOPT_PROXY] = getenv("GettyImagesApi_UseProxy");
            }

            if(getenv("GettyImagesApi_IgnoreSSLValidation") != null) {
                if(getenv("GettyImagesApi_IgnoreSSLValidation") == TRUE) {
                    $defaults[CURLOPT_SSL_VERIFYHOST] = 0;
                    $defaults[CURLOPT_SSL_VERIFYPEER] = 0;
                }
            }

            return $defaults + $options;
        }

        /**
         * @ignore
         */
        private function execute(array $options) {
            
            $options = self::getCurlDefaults($options);

            return $this->container->get('ICurler')->execute($options);
        }

    }
}
