<?php

namespace GettyImages\Api\Curler {

    class Curler implements ICurler
    {
        public function execute($options)
        {
            $this->options = $options;

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