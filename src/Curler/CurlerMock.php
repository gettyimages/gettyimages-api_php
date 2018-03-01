<?php

namespace GettyImages\Api\Curler {

    class CurlerMock implements ICurler
    {
        public $options;

        public function execute($options)
        {
            $this->options = $options;
            $result = array( 'header' => '',    
                'body' => '{"access_token":"test_token","token_type":"Bearer","expires_in":"1476"}',
                'curl_error' => '',
                'http_code' => 200,
                'last_url' => '',
                'debugInfo' => '');

            return $result;
        }
        
    }

}