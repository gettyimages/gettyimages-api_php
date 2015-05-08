<?php

namespace GettyImages\Api\Request\Download {

    use GettyImages\Api\Request\FluentRequest;
    use GettyImages\Api\Request\WebHelper;

    //Require Other Search Types
    require_once("DownloadImage.php");
    require_once("DownloadVideo.php");

    class Download extends FluentRequest {

        /**
         * @return string
         */
        protected function getRoute() {
            return "downloads/";
        }

        /**
         * Creates a download configured for Images.
         *
         * @return DownloadImage DownloadImage object;
         */
        public function Image() {
            $newDownloadObject = new DownloadImage($this->credentials,$this->endpointUri, $this->requestDetails);

            return $newDownloadObject;
        }
        
        /**
         * Creates a download configured for Videos.
         *
         * @return DownloadVideo DownloadVideo object;
         */
        public function Video() {
            $newDownloadObject = new DownloadVideo($this->credentials,$this->endpointUri, $this->requestDetails);

            return $newDownloadObject;
        }
    }
}