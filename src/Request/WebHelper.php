<?php
/**
 * Provides general helpers around curl
 */

namespace GettyImages\Connect\Request {

    /**
     * @ignore
     */
    class WebHelper {
        public static function getJsonWebRequest($endpoint, $params = NULL, array $options = array()) {
            $json_response = self::curl_get($endpoint, $params, $options);

            return $json_response;
        }

        public static function postFormEncodedWebRequest($endpoint, $data, array $options = array()) {

            $defaults = array(CURLOPT_HEADER => 'Content-Type: application/x-www-form-urlencoded');

            $result = self::curl_post($endpoint,$data, ($defaults + $options));
            return $result;
        }

        /**
         * Send a POST requst using cURL
         * @param string $url to request
         * @param array $post values to send
         * @param array $options for cURL
         * @return string
         */
        public static function curl_post($url, array $post = NULL, array $options = array()) {

            $options[CURLOPT_POST] = 1;
            $options[CURLOPT_URL] = $url;
            $options[CURLOPT_POSTFIELDS] = http_build_query($post);

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
            $defaults = array(
                CURLOPT_HEADER => 1,
                CURLOPT_FRESH_CONNECT => 1,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_FORBID_REUSE => 1,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_SSL_VERIFYPEER => 1
            );

            if(getenv("ConnectSDK_UseProxy") != null) {
                $defaults[CURLOPT_PROXY] = getenv("ConnectSDK_UseProxy");
            }

            if(getenv("ConnectSDK_IgnoreSSLValidation") != null) {
                if(getenv("ConnectSDK_IgnoreSSLValidation") == TRUE) {
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
                'last_url' => '');
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