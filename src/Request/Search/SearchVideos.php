<?php

namespace GettyImages\Api\Request\Search {
    
    use GettyImages\Api\Request\FluentRequest;
    use GettyImages\Api\Request\WebHelper;
    use Exception;
    
    class SearchVideos extends FluentRequest {

        /**
         * @ignore
         */
        protected $route = "search/videos/";

        protected function getRoute() {
            return $this->route;
        }

        protected function getMethod() {
            return "get";
        }

        /**
         * @param array $ages An array of ages by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withAgeOfPeople(array $ages) {
            $this->addArrayOfValuesToRequestDetails("age_of_people",$ages);
            return $this;
        }

        /**
         * @param array $collectionCodes An array of collection codes by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withCollectionCodes(array $collectionCodes) {
            $this->addArrayOfValuesToRequestDetails("collection_codes",$collectionCodes);
            return $this;
        }

        /**
         * @param string $filter
         * @return $this
         */
        public function withCollectionFilterType(string $filter) {
            $this->requestDetails["collections_filter_type"] = $filter;
            return $this;
        }

        /**
         * @param array $videoTypes An array of video types by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withEditorialVideoTypes(array $videoTypes) {
            $this->addArrayOfValuesToRequestDetails("editorial_video_types",$videoTypes);
            return $this;
        }

        /**
         * @return $this
         */
        public function withExcludeNudity() {
            $this->requestDetails["exclude_nudity"] = "true";
            return $this;
        }

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
         * @param string $format
         * @return $this
         */
        public function withAvailableFormat(string $format) {
            $this->requestDetails["format_available"] = strtolower($format);
            return $this;
        }

        /**
         * @param array $frameRates An array of frame rates by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withFrameRates(array $frameRates) {
            $this->addArrayOfValuesToRequestDetails("frame_rates",$frameRates);
            return $this;
        } 

        /**
         * @param array $keywordIds An array of keyword ids by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withKeywordIds(array $keywordIds) {
            $this->addArrayOfValuesToRequestDetails("keyword_ids",$keywordIds);
            return $this;
        } 

        /**
         * @param array $licenseModels An array of license models by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withLicenseModels(array $licenseModels) {
            $this->addArrayOfValuesToRequestDetails("license_models",$licenseModels);
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
         * @param string $phrase
         * @return $this
         */
        public function withPhrase(string $phrase) {
            $this->requestDetails["phrase"] = $phrase;

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

        /**
         * @param string $order
         * @return $this
         */
        public function withSortOrder(string $order) {
            $this->requestDetails["sort_order"] = $order;
            return $this;
        }
        
        /**
         * @param array $people An array of people by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withSpecificPeople(array $people) {
            $this->addArrayOfValuesToRequestDetails("specific_people", $people);
            return $this;
        }
    }
}