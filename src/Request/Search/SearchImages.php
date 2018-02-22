<?php
/**
 * Contains the implementations of Image Searching
 */

namespace GettyImages\Api\Request\Search {
    //Require Filters
    require_once("Filters/EthnicityFilter.php");
    require_once("Filters/EditorialSegmentFilter.php");
    require_once("Filters/GraphicalStyleFilter.php");
    require_once("Filters/LicenseModelFilter.php");
    require_once("Filters/OrientationFilter.php");
    require_once("Filters/NumberOfPeopleFilter.php");
    require_once("Filters/AgeOfPeopleFilter.php");
    require_once("Filters/FileTypeFilter.php");
    require_once("Filters/FormatFilter.php");
    require_once("Filters/CompositionFilter.php");

    use GettyImages\Api\Request\FluentRequest;
    use GettyImages\Api\Request\WebHelper;
    use Exception;
    
    use GettyImages\Api\Request\Search\Filters\GraphicalStyleFilter;
    use GettyImages\Api\Request\Search\Filters\LicenseModelFilter;
    use GettyImages\Api\Request\Search\Filters\OrientationFilter;
    use GettyImages\Api\Request\Search\Filters\NumberOfPeopleFilter;
    
    use GettyImages\Api\Request\Search\Filters\EthnicityFilter;
    use GettyImages\Api\Request\Search\Filters\FileTypeFilter;
    use GettyImages\Api\Request\Search\Filters\CompositionFilter;

    /**
     * Provides Image Search specific behavior
     */
    class SearchImages extends FluentRequest {

        /**
         * @ignore
         */
        protected $route = "search/images/";

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
         * @param $age
         * @return $this
         */
        public function withAgeOfPeople($ages) {
            $this->addArrayOfValuesToRequestDetails("age_of_people",$ages);
            return $this;
        }

        /**
         * @param $artists
         * @return $this
         */
        public function withArtists($artists) {
            $this->addArrayOfValuesToRequestDetails("artists",$artists);
            return $this;
        } 

        /**
         * @param $collectionCodes
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
         * @param $composition
         * @return $this
         */
        public function withComposition($compositions) {
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
         * @param $ethnicity
         * @throws Exception
         * @return $this
         */
        public function withEthnicity($ethnicities) {
            $this->addArrayOfValuesToRequestDetails("ethnicity",$ethnicities);
            return $this;
        }

        /**
         * @param $eventId
         * @throws Exception
         * @return $this
         */
        public function withEventIds($eventIds) {
            $this->addArrayOfValuesToRequestDetails("event_ids",$eventIds);
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
        public function withFields(array $fields) {
            $this->addArrayOfValuesToRequestDetails("fields", $fields);
            return $this;
        }

        /**
         * @param $fileType
         * @throws Exception
         * @return $this
         */
        public function withFileTypes($fileTypes) {
            $this->addArrayOfValuesToRequestDetails("file_types",$fileTypes);
            return $this;
        }

        /**
         * @param $graphicalStyle
         * @throws Exception
         * @return $this
         */
        public function withGraphicalStyles($graphicalStyles) {
            $this->addArrayOfValuesToRequestDetails("graphical_styles",$graphicalStyles);
            return $this;
        }

        /**
         * @param $keywordId
         * @throws Exception
         * @return $this
         */
        public function withKeywordIds($keywordIds) {
            $this->addArrayOfValuesToRequestDetails("keyword_ids",$keywordIds);
            return $this;
        } 

        /**
         * @param $licenseModel
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
         * @param $set
         * @return $this
         */
        public function withNumberOfPeople($people) {
            $this->addArrayOfValuesToRequestDetails("number_of_people",$people);
            return $this;
        }

        /**
         * @param OrientationFilter $orientation
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
        
        /**
         * @param $people
         * @return $this
         */
        public function withSpecificPeople($people) {
            $this->addArrayOfValuesToRequestDetails("specific_people", $people);
            return $this;
        }
    }
}
