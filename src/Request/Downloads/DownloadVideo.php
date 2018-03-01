<?php

namespace GettyImages\Api\Request\Downloads  {

    use GettyImages\Api\Request\FluentRequest;
    use GettyImages\Api\Request\WebHelper;

    class DownloadVideo extends FluentRequest {

        /**
         * @ignore
         */
        protected $route = "downloads/videos/";

        /**
         * @ignore
         */
        protected $videoIdToLookup;

        public function __construct(&$credentials, $endpointUri, $container) {
            $this->requestDetails["auto_download"] = "false";
            parent::__construct($credentials, $endpointUri, $container);
        }

        protected function getRoute() {
            $this->route = $this->route.$this->videoIdToLookup;

            return $this->route;
        }

        protected function getMethod() {
            return "post";
        }

        /**
         * @param string $assetId
         * @return $this
         */
        public function withId(string $assetId) {
            $this->videoIdToLookup = $assetId;
            return $this;
        }

        /**
         * @return $this
         */
        public function withAutoDownload() {
            $this->requestDetails["auto_download"] = "true";
            return $this;
        }
        
        /**
         * @param int $productId
         * @return $this
         */
        public function withProductId(int $productId) {
            $this->requestDetails["product_id"] = $productId;
            return $this;
        }

        /**
         * @param string $size
         * @return $this
         */
        public function withSize(string $size) {
            $this->requestDetails["size"] = $size;
            return $this;
        }
    }
}