<?php

namespace GettyImages\Api\Request\Search {

    use GettyImages\Api\Request\FluentRequest;
    use GettyImages\Api\Request\WebHelper;
    use Exception;

    class SearchImagesCreativeByImage extends FluentRequest {

        /**
         * @ignore
         */
        protected $route = "search/images/creative/by-image";

        /**
         * Gets the route configuration of the current search
         *
         * @return string The relative route for this request type
         */
        public function getRoute() {
            return $this->route;
        }

        protected function getMethod() {
            return "get";
        }

        protected function addToBucket(string $imageFilepath)
        {
            $g = com_create_guid();
            $path = "https://search-by-image.s3.amazonaws.com/".$g;

            //set to put
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

        }

        public function addToBucketAndSearch(string $imageFilepath)
        {
            $url = $this->addToBucket($imageFilepath);
            $this->withImageUrl($url);
            return $this;
        }

        //ACCEPT LANG

        /**
         * Will set the search request to only return the fields provided.
         *
         * @param array $fields An array of field names to include in the response.
         * this list isn't exclusive, default fields are always returned.
         * @throws Exception
         * @return $this
         */
        public function withFields(array $fields) {
            $this->addArrayOfValuesToRequestDetails("fields", $fields);
            return $this;
        }

        /**
         * @param string $imageFingerprint
         * @return $this
         */
        public function withImageFingerprint(string $imageFingerprint) {
            $this->requestDetails["image_fingerprint"] = $imageFingerprint;
            return $this;
        }

        /**
         * @param string $imageUrl
         * @return $this
         */
        public function withImageUrl(string $imageUrl) {
            $this->requestDetails["image_url"] = $imageUrl;
            return $this;
        }

        /**
         * @param int $pageNum
         * @return $this
         */
        public function withPage(int $pageNum) {
            $this->requestDetails["page"] = $pageNum;
            return $this;
        }

        /**
         * @param int $pageSize
         * @return $this
         */
        public function withPageSize(int $pageSize) {
            $this->requestDetails["page_size"] = $pageSize;
            return $this;
        }

        /**
         * @param array $productTypes An array of product types by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withProductTypes(array $productTypes) {
            $this->addArrayOfValuesToRequestDetails("product_types", $productTypes);
            return $this;
        }
    }
}