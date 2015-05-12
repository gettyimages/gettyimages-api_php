<?php

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

    //Require Other Search Types
    require_once("SearchImages.php");
    require_once("SearchImagesCreative.php");
    require_once("SearchImagesEditorial.php");

    require_once("SearchVideos.php");
    require_once("SearchVideosCreative.php");
    require_once("SearchVideosEditorial.php");

    use GettyImages\Api\Request\FluentRequest;
    use GettyImages\Api\Request\WebHelper;

    use Exception;
    use GettyImages\Api\Request\Search\Filters\AgeOfPeopleFilter;
    use GettyImages\Api\Request\Search\Filters\LicenseModelFilter;    

    /**
     * Provides the basic infrastructure for building up a Search Request.
     *
     * @method Search QueryParameter(string $value) Where QueryParameter can be any field you want to append to the request query parameters.
     */
    class Search extends FluentRequest {

        /**
         * @return string
         */
        protected function getRoute() {
            return "search/";
        }

        /**
         * Creates a search configured for Images.
         *
         * @return SearchImages SearchImages object;
         */
        public function Images() {
            $newSearchObject = new SearchImages($this->credentials,$this->endpointUri, $this->requestDetails);
            return $newSearchObject;
        }

        /**
         * Creates a search configured for Videos.
         *
         * @return SearchVideos SearchVideos object;
         */
        public function Videos() {
            $newSearchObject = new SearchVideos($this->credentials,$this->endpointUri, $this->requestDetails);
            return $newSearchObject;
        }

        /**
         *    Realizes the search request. Causes the request to go out and get processed
         *
         *
         * @throws \Exception
         * @return string Json package of the search results
         */
        public function execute() {
            $endpointUrl = $this->endpointUri."/".$this->getRoute();

            if(!$this->credentials->getAuthorizationHeaderValue()) {
                $authHeader = array(CURLOPT_HTTPHEADER =>
                                    array("Api-Key:".$this->credentials->getApiKey()));
            } else {
                $authHeader = array(CURLOPT_HTTPHEADER =>
                                    array("Api-Key:".$this->credentials->getApiKey(),
                                          "Authorization: ".$this->credentials->getAuthorizationHeaderValue()));
            }

            $response = WebHelper::getJsonWebRequest($endpointUrl,
                                                     $this->requestDetails,
                                                     $authHeader);

            if($response["http_code"] != 200) {
                throw new \Exception("Non 200 status code returned: " .$response["http_code"] . "\nBody: ". $response["body"]);
            }

            return $response["body"];
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
         * Adds the specific request field to the results
         */
        public function withResponseField($fieldName) {
            $this->appendArrayValueToRequestDetails("fields",$fieldName);
            return $this;
        }

        /**
         * @param $startDate
         * @return $this
         */
        public function withStartDate($startDate) {
            $this->requestDetails["start_date"] = $startDate;
            return $this;
        }

        /**
         * @param $endDate
         * @return $this
         */
        public function withEndDate($endDate) {
            $this->requestDetails["end_date"] = $endDate;
            return $this;
        }

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
        
        /**
         * @param $collectionCode
         * @return $this
         */
        public function withoutCollectionCode($collectionCode) {
            $this->requestDetails["collection_codes"] = $collectionCode;
            $this->requestDetails["collections_filter_type"] = "exclude";
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
         * @param ProductTypeFilter $productType
         * @throws Exception
         * @return $this
         */
        public function withProductType($productType) {
            $this->appendArrayValueToRequestDetails("product_types", $productType);
            return $this;
        }

        /**
         * @param $people
         * @return $this
         */
        public function withSpecificPeople($people) {
            $this->requestDetails["specific_people"] = $people;
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
         * @param $licenseModel
         * @throws Exception
         * @return $this
         */
        public function withLicenseModel(LicenseModelFilter $licenseModel) {
            $this->appendArrayValueToRequestDetails("license_models",$licenseModel->getValue());
            return $this;
        }
    }
}