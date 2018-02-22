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

        //ACCEPT LANG

        /**
         * @param $ages An array of ages by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withAgeOfPeople($ages) {
            $this->addArrayOfValuesToRequestDetails("age_of_people",$ages);
            return $this;
        }

        /**
         * @param $artists An array of artists by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withArtists($artists) {
            $this->addArrayOfValuesToRequestDetails("artists",$artists);
            return $this;
        } 

        /**
         * @param $collectionCodes An array of collection codes by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withCollectionCodes($collectionCodes) {
            $this->addArrayOfValuesToRequestDetails("collection_codes",$collectionCodes);
            return $this;
        }

        /**
         * @param $filter
         * @return $this
         */
        public function withCollectionFilterType(CollectionFilter $filter) {
            $this->requestDetails["collections_filter_type"] = $filter->getValue();
            return $this;
        }

        /**
         * @return $this
         */
        public function withColor($color) {
            $this->requestDetails["color"] = $color;
            return $this;
        }

        /**
         * @param $compositions An array of compositions by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withCompositions($compositions) {
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
         * @param $ethnicities An array of ethnicities by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withEthnicity($ethnicities) {
            $this->addArrayOfValuesToRequestDetails("ethnicity",$ethnicities);
            return $this;
        }

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
         * @throws Exception
         * @return $this
         */
        public function withFields(array $fields) {
            $this->addArrayOfValuesToRequestDetails("fields", $fields);
            return $this;
        }

        /**
         * @param $fileTypes An array of file types by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withFileTypes($fileTypes) {
            $this->addArrayOfValuesToRequestDetails("file_types",$fileTypes);
            return $this;
        }

        /**
         * @param $graphicalStyles An array of graphical styles by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withGraphicalStyles($graphicalStyles) {
            $this->addArrayOfValuesToRequestDetails("graphical_styles",$graphicalStyles);
            return $this;
        }

        /**
         * @param $keywordIds An array of keyword ids by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withKeywordIds($keywordIds) {
            $this->addArrayOfValuesToRequestDetails("keyword_ids",$keywordIds);
            return $this;
        } 

        /**
         * @param $licenseModels An array of license models by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withLicenseModels($licenseModels) {
            $this->addArrayOfValuesToRequestDetails("license_models",$licenseModels);
            return $this;
        }

           /**
         * @param $minimumSize
         * @throws Exception
         * @return $this
         */
        public function withMinimumSize($minimumSize) {
            $this->requestDetails["minimum_size"] = $minimumSize;
            return $this;
        }

        /**
         * @param $people An array of numbers of people in image by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withNumberOfPeople($people) {
            $this->addArrayOfValuesToRequestDetails("number_of_people",$people);
            return $this;
        }

        /**
         * @param $orientations An array of orientations by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withOrientations($orientations) {
            $this->addArrayOfValuesToRequestDetails("orientations",$orientations);
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
         * Scopes response down to only prestige curated content
         */
        public function withPrestigeContentOnly()
        {
            $this->requestDetails["prestige_content_only"] = "true";
            return $this;
        }

        /**
         * @param $productTypes An array of product types by which to filter.
         * @throws Exception
         * @return $this
         */
        public function withProductTypes($productTypes) {
            $this->addArrayOfValuesToRequestDetails("product_types", $productTypes);
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