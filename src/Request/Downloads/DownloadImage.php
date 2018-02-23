<?php

namespace GettyImages\Api\Request\Downloads  {

    use GettyImages\Api\Request\WebHelper;

    class DownloadImage extends Download {

        /**
         * @ignore
         */
        protected $route = "downloads/images/";

        /**
         * @ignore
         */
        protected $imageIdToLookup;

        public function __construct() {
            $this->requestDetails["auto_download"] = "false";
        }

        /**
         * Gets the route configuration of the current search
         *
         * @return string The relative route for this request type
         */
        public function getRoute() {
            $this->route = $this->route.$this->imageIdToLookup;

            return $this->route;
        }

        /**
         * @access private
         */
        public function getMethod() {
            return "post";
        }

        /**
         * @param string $assetId
         * @return $this
         */
        public function withId(string $assetId) {
            $this->imageIdToLookup = $assetId;
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
         * @param string $fileType
         * @return $this
         */
        public function withFileType(string $fileType) {
            $this->requestDetails["file_type"] = $fileType;
            return $this;
        }

        /**
         * @param string $height
         * @return $this
         */
        public function withHeight(string $height) {
            $this->requestDetails["height"] = $height;
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
         * @param string $productType
         * @return $this
         */
        public function withProductType(string $productType) {
            $this->requestDetails["product_type"] = $productType;
            return $this;
        }
    }

}