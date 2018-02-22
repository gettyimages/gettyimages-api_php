<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 9/17/14
 * Time: 10:42 AM
 */

namespace GettyImages\Api\Request\Search {

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
         * @param $artists
         * @return $this
         */
        public function withArtists($artists) {
            $this->requestDetails["artists"] = $artists;
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

        //COLOR

        /**
         * @param $composition
         * @return $this
         */
        public function withComposition(CompositionFilter $compositions) {
            $this->appendArrayValueToRequestDetails("compositions",$compositions->getValue());
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
         * @param $ethnicity
         * @throws Exception
         * @return $this
         */
        public function withEthnicity(EthnicityFilter $ethnicity) {
            $this->appendArrayValueToRequestDetails("ethnicity",$ethnicity->getValue());
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
         * @return $this
         */
        public function Fields(array $fields) {
            $this->requestDetails["fields"] = $fields;
            return $this;
        }

        /**
         * @param $fileType
         * @throws Exception
         * @return $this
         */
        public function withFileType(FileTypeFilter $fileType) {
            $this->appendArrayValueToRequestDetails("file_types",$fileType->getValue());
            return $this;
        }

        /**
         * @param $graphicalStyle
         * @throws Exception
         * @return $this
         */
        public function withGraphicalStyle(GraphicalStyleFilter $graphicalStyle) {
            $this->appendArrayValueToRequestDetails("graphical_styles",$graphicalStyle->getValue());
            return $this;
        }

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

        //MINIMUM SIZE

        /**
         * @param $set
         * @return $this
         */
        public function withNumberOfPeople(NumberOfPeopleFilter $people) {
            $this->appendArrayValueToRequestDetails("number_of_people",$people->getValue());
            return $this;
        }

        /**
         * @param OrientationFilter $orientation
         * @throws Exception
         * @return $this
         */
        public function withOrientation(OrientationFilter $orientation) {
            $this->appendArrayValueToRequestDetails("orientations",$orientation->getValue());
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
        public function withOnlyPrestigeContent()
        {
            $this->requestDetails["prestige_content_only"] = "true";
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