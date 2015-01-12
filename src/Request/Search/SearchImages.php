<?php
/**
 * Contains the implementations of Image Searching
 */

namespace GettyImages\Connect\Request\Search {
    use Exception;
    use GettyImages\Connect\Request\Search\Filters\GraphicalStyle\GraphicalStyleFilter;
    use GettyImages\Connect\Request\Search\Filters\LicenseModel\LicenseModelFilter;
    use GettyImages\Connect\Request\Search\Filters\Orientation\OrientationFilter;

    /**
     * Provides Image Search specific behavior
     */
    class SearchImages extends Search {

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

        /**
         * Will create a search configuration that support creative only image searching
         *
         * @internal param \GettyImages\SDK\string|string $phrase optionally provide a search phrase, shortcut to calling Phrase()
         * @return SearchImages Configured for a creative search
         */
        public function Creative() {
            return new SearchImagesCreative($this->credentials,$this->endpointUri,$this->requestDetails);
        }

        /**
         * Will create a search configuration that support editorial only image searching
         *
         * @return SearchImages Configured for a editorial image search
         */
        public function Editorial() {
            return new SearchImagesEditorial($this->credentials,$this->endpointUri, $this->requestDetails);
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

        public function withProductType($type) {
            $this->appendArrayValueToRequestDetails("product_types", $type);
            return $this;
        }

        /**
         * @param OrientationFilter $orientation
         * @internal param \Orientation|\use $orientationName use values from Orientation::
         * @return $this
         */
        public function withOrientation(OrientationFilter $orientation) {

            $this->appendArrayValueToRequestDetails("orientations",$orientation->getValue());
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
         * @param string $val
         * @return $this
         */
        public function withExcludeNudity($val = "true") {
            $this->requestDetails["exclude_nudity"] = $val;
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
         * @param $order
         * @return $this
         */
        public function withSortOrder($order) {
            $this->requestDetails["sort_order"] = $order;

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

        public function withEmbeddableImagesOnly() {
            $this->requestDetails["embed_content_only"] = "true";

            return $this;
        }
    }
}
