<?php

namespace GettyImages\Api\Request\Images {

    use GettyImages\Api\Request\FluentRequest;
    use GettyImages\Api\Request\WebHelper;
    use Exception;
    
    class Images extends FluentRequest {

        /**
         * @access private
         */
        private $imageIdsToLookup = array();

        /**
         * @ignore
         */
        protected $route = "images/";

        protected function getRoute() {
            $imageIds = $this->imageIdsToLookup;
            
            if(count($imageIds) == 1) {
                $this->route = $this->route.implode(",", $imageIds);
            } else {
                $this->addArrayOfValuesToRequestDetails("ids", $imageIds);
            }

            return $this->route;
        }

        protected function getMethod() {
            return "get";
        }
       
        /**
         * @param array $imageIds
         * @return $this
         */
        public function withIds(array $imageIds) {
            $this->imageIdsToLookup = $imageIds;
            return $this;
        }

        /**
         * @param string $imageId
         * @return $this
         */
        public function withId(string $imageId) {
            array_push($this->imageIdsToLookup,$imageId);
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
    }
}
