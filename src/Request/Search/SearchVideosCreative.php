<?php

namespace GettyImages\Api\Request\Search {

    class SearchVideosCreative extends FluentRequest {

        /**
         * @ignore
         */
        protected $route = "search/videos/creative/";

        /**
         * Gets the route configuration of the current search
         *
         * @return string The relative route for this request type
         */
        public function getRoute() {
            return $this->route;
        }

        //ACCEPT LANG

        /**
         * @param $age
         * @return $this
         */
        public function withAgeOfPeople(AgeOfPeopleFilter $age) {
            $this->appendArrayValueToRequestDetails("age_of_people",$age->getValue());
            return $this;
        }

        /**
         * @param $collectionCode
         * @return $this
         */
        public function withCollectionCode($collectionCode) {
            $this->requestDetails["collection_codes"] = $collectionCode;
            $this->requestDetails["collections_filter_type"] = "include";
            return $this;
        }

        //COLLECTION TYPE

        /**
         * @param string $val
         * @return $this
         */
        public function withExcludeNudity($val = "true") {
            $this->requestDetails["exclude_nudity"] = $val;
            return $this;
        }

        /**
         * Will set the search request to only return the fields provided.
         *
         * @param array $fields An array of field names to include in the response.
         * this list isn't exclusive, default fields are always returned.
         * @return $this
         */
        public function Fields(array $fields) {
            $this->requestDetails["fields"] = $fields;
            return $this;
        }

                /**
         * @param $formatFilter
         * @return $this
         */
        public function withFormatFilter(FormatFilter $formatFilter) {

            $this->appendArrayValueToRequestDetails("format_available",$formatFilter->getValue());
            return $this;
        }

        //FRAMERATE

        /**
         * @param $keywordId
         * @throws Exception
         * @return $this
         */
        public function withKeywordId($keywordId) {
            if (!is_int($keywordId) || $keywordId<0) {
                throw new InvalidArgumentException('withKeywordId function only accepts positive integers. Input was: '.$keywordId); 
            }
            $this->requestDetails["keyword_ids"] = $keywordId;
            return $this;
        } 

        /**
         * @param $licenseModel
         * @throws Exception
         * @return $this
         */
        public function withLicenseModel(LicenseModelFilter $licenseModel) {
            $this->appendArrayValueToRequestDetails("license_models",$licenseModel->getValue());
            return $this;
        }

        /**
         * @param $pageNum
         * @return $this
         */
        public function withPage($pageNum) {
            $this->requestDetails["page"] = $pageNum;
            return $this;
        }

        /**
         * @param $pageSize
         * @return $this
         */
        public function withPageSize($pageSize) {
            $this->requestDetails["page_size"] = $pageSize;
            return $this;
        }

        /**
         * @param $phrase
         * @return $this
         */
        public function withPhrase($phrase) {
            $this->requestDetails["phrase"] = $phrase;

            return $this;
        }

        /**
         * @param ProductTypeFilter $productType
         * @throws Exception
         * @return $this
         */
        public function withProductType($productType) {
            $this->appendArrayValueToRequestDetails("product_types", $productType);
            return $this;
        }

        /**
         * @param $order
         * @return $this
         */
        public function withSortOrder($order) {
            $this->requestDetails["sort_order"] = $order;
            return $this;
        }
    }
}