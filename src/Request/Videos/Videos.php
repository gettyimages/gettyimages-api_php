<?php

namespace GettyImages\Api\Request\Videos {

    use GettyImages\Api\Request\FluentRequest;
    use GettyImages\Api\Request\WebHelper;
    use Exception;
    
    class Videos extends FluentRequest {

        /**
         * @access private
         */
        private $videoIdsToLookup = array();

        /**
         * @access private
         */
        private $route = "videos/";

        protected function getRoute() {
            $videoIds = $this->videoIdsToLookup;
            
            if(count($videoIds) == 1) {
                $this->route = $this->route.implode(",", $videoIds);
            } else {
                $this->addArrayOfValuesToRequestDetails("ids", $videoIds);
            }

            return $this->route;
        }

        protected function getMethod() {
            return "get";
        }

        /**
         * @param array $videoIds
         * @return $this
         */
        public function withIds(array $videoIds) {
            
            $this->videoIdsToLookup = $videoIds;
            
            return $this;
        }

        /**
         * @param string $videoId
         * @return $this
         */
        public function withId(string $videoId) {
			array_push($this->videoIdsToLookup,$videoId);

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