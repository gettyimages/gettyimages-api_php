<?php
/**
 * Images.php
 *
 */

namespace GettyImages\Api\Request {

    /**
     * Images
     *
     * Provides the Images request.
     */
    class Images extends FluentRequest {

        /**
         * @access private
         */
        private $imageIdsToLookup = array();

        /**
         * Creates a search configured for Images.
         *
         * @param array $imageIds
         * @throws \Exception
         * @return Images;
         */
        public function withIds(array $imageIds = null) {
            if(!$imageIds) {
                throw new \Exception('expected $ids parameter to have at least one value');
            }
            
            $this->requestDetails["ids"] = $imageIds;
            
            return $this;
        }

        public function withId($imageId) {
            array_push($this->imageIdsToLookup,$imageId);

            return $this;
        }

        /**
         * Will set the request to only return the fields provided.
         *
         * @param array $fields An array of field names to include in the response.
         * this list isn't exclusive, default fields are always returned.
         * @return $this
         */
        public function Fields(array $fields) {
            $this->requestDetails["fields"] = $fields;
            return $this;
        }
        
        public function withResponseField($fieldName) {
           $this->appendArrayValueToRequestDetails("fields",$fieldName);
            return $this;
        }

        /**
         * @access private
         */
        public function getRoute() {
            $imageIds = $this->imageIdsToLookup;
            
            if(count($imageIds) == 1) {
                $route = "images/".implode(",", $imageIds);
            } else {
                $route = "images";
            }

            return $route;
        }
    }
}
