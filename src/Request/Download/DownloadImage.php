<?php

namespace GettyImages\Api\Request\Download  {

    use GettyImages\Api\Request\WebHelper;

    class DownloadImage extends Download {

        /**
         * @ignore
         */
        protected $route = "downloads/images";

        /**
         * Gets the route configuration of the current search
         *
         * @return string The relative route for this request type
         */
        public function getRoute() {
            return $this->route;
        }

        public function withId($assetId) {
            $this->requestDetails["id"] = $assetId;
            return $this;
        }

        public function withHeight($height) {
            $this->requestDetails["height"] = $height;
            return $this;
        }
        
        public function withFileType($fileType) {
            $this->requestDetails["file_type"] = $fileType;
            return $this;
        }

        public function execute() {

            $assetId = $this->requestDetails["id"];
            unset($this->requestDetails["id"]);

            $this->requestDetails["auto_download"] = "false";

            $endpointUrl = $this->endpointUri."/".$this->getRoute()."/".$assetId;

            $credentialHeaders = array(CURLOPT_HTTPHEADER =>
                array("Api-Key: ". $this->credentials->getApiKey(),
                    "Authorization: ".$this->credentials->getAuthorizationHeaderValue()));
                                       
            $response = WebHelper::postWithNoBody($endpointUrl, $this->requestDetails, $credentialHeaders);
            
            if($response["http_code"] != 200 && $response["http_code"] != 303) {
                throw new \Exception("Non 200/303 status code returned: '" . $response["http_code"] . "'\nBody: ". $response["body"] . "\nCurl Error: " . $response["curl_error"]);
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
            } else {
                return $response['body'];
            }
                

            return $response;
        }
    }

}