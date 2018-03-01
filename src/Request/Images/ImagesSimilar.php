<?php

namespace GettyImages\Api\Request\Images {

    use GettyImages\Api\Request\FluentRequest;
    use GettyImages\Api\Request\WebHelper;
    use Exception;
    
    class ImagesSimilar extends FluentRequest {

        /**
         * @access private
         */
        private $imageIdToLookup;

        /**
         * @ignore
         */
        protected $route = "images/";

        protected function getRoute() {
            $this->route = $this->route.$this->imageIdToLookup."/similar";

            return $this->route;
        }

        protected function getMethod() {
            return "get";
        }

        /**
         * @param string $imageId
         * @return $this
         */
        public function withId(string $imageId) {
            $this->imageIdToLookup = $imageId;
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
    }
}