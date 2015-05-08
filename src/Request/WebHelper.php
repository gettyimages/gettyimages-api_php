<?php
/**
 * Provides general helpers around curl
 */

namespace GettyImages\Api\Request {

    /**
     * @ignore
     */
    class WebHelper {
        public static function getJsonWebRequest($endpoint, $params = NULL, array $options = array()) {
            $json_response = self::curl_get($endpoint, $params, $options);

            return $json_response;
        }

        public static function postFormEncodedWebRequest($endpoint,array $data, array $options = array()) {

            $data = http_build_query($data);
            $defaults = array(
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Content-Length: ' . strlen($data)),
                CURLOPT_POST => 1,
            );

            $defaults[CURLOPT_URL] = $endpoint;
            $defaults[CURLOPT_POSTFIELDS] = $data;

            $result = self::execute(($options + $defaults));

            return $result;
        }

        public static function postWithNoBody($endpoint, $queryParams, array $options = array()) {

            $endpoint = $endpoint. (strpos($endpoint, '?') === FALSE ? '?' : ''). self::BuildQueryParams($queryParams);

            if(!array_key_exists(CURLOPT_HTTPHEADER, $options)) {
                $options[CURLOPT_HTTPHEADER] = array();
            }

            array_push($options[CURLOPT_HTTPHEADER],'Content-Type: application/json');
            array_push($options[CURLOPT_HTTPHEADER], 'Content-Length: 0');
            $options[CURLOPT_POST] = 1;
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
        public static function curl_get($url, array $requestParams = NULL, array $options = array()) {
            $url = $url. (strpos($url, '?') === FALSE ? '?' : ''). self::BuildQueryParams($requestParams);
            $options[CURLOPT_URL] = $url;

            $result = self::execute($options);

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
        private static function execute(array $options) {

            $options = self::getCurlDefaults($options);
            
            $ch = curl_init();
            curl_setopt_array($ch, $options);
            $response = curl_exec($ch);

            $error = curl_error($ch);
            $result = array( 'header' => '',
                'body' => '',
                'curl_error' => '',
                'http_code' => '',
                'last_url' => '',
                'debugInfo' => '');
            if ( $error != "" )
            {
                $result['curl_error'] = $error;
                return $result;
            }

            $header_size = curl_getinfo($ch,CURLINFO_HEADER_SIZE);
            $result['header'] = substr($response, 0, $header_size);
            $result['body'] = substr( $response, $header_size );
            $result['http_code'] = curl_getinfo($ch,CURLINFO_HTTP_CODE);
            $result['last_url'] = curl_getinfo($ch,CURLINFO_EFFECTIVE_URL);
            curl_close($ch);
            return $result;
        }

    }
}
