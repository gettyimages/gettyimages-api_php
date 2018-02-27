<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 9/17/14
 * Time: 10:42 AM
 */

namespace GettyImages\Api\Request\Search {

    use GettyImages\Api\Request\FluentRequest;
    use GettyImages\Api\Request\WebHelper;
    use Exception;

    class SearchImagesCreative extends FluentRequest {

        /**
         * @ignore
         */
        protected $route = "search/images/creative/";

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
         * @param array $artists An array of artists by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withArtists(array $artists) {
            $this->addArrayOfValuesToRequestDetails("artists",$artists);
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
         * @param string $color
         * @return $this
         */
        public function withColor(string $color) {
            $this->requestDetails["color"] = $color;
            return $this;
        }

        /**
         * @param array $compositions An array of compostitions by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withCompositions(array $compositions) {
            $this->addArrayOfValuesToRequestDetails("compositions",$compositions);
            return $this;
        }

        /**
         * @return $this
         */
        public function withEmbedContentOnly() {
            $this->requestDetails["embed_content_only"] = "true";
            return $this;
        }

        /**
         * @param array $ethnicities An array of ethnicities by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withEthnicity(array $ethnicities) {
            $this->addArrayOfValuesToRequestDetails("ethnicity",$ethnicities);
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
         * @param array $fileTypes An array of file types by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withFileTypes(array $fileTypes) {
            $this->addArrayOfValuesToRequestDetails("file_types",$fileTypes);
            return $this;
        }

        /**
         * @param array $graphicalStyles An array of graphical styles by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withGraphicalStyles(array $graphicalStyles) {
            $this->addArrayOfValuesToRequestDetails("graphical_styles",$graphicalStyles);
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
         * @param string $minimumSize
         * @return $this
         */
        public function withMinimumSize(string $minimumSize) {
            $this->requestDetails["minimum_size"] = $minimumSize;
            return $this;
        }

        /**
         * @param array $people An array of numbers of people in image by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withNumberOfPeople(array $people) {
            $this->addArrayOfValuesToRequestDetails("number_of_people",$people);
            return $this;
        }

        /**
         * @param array $orientations An array of orientations by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withOrientations(array $orientations) {
            $this->addArrayOfValuesToRequestDetails("orientations",$orientations);
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
         * @return $this
         */
        public function withPrestigeContentOnly()
        {
            $this->requestDetails["prestige_content_only"] = "true";
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
    }
}