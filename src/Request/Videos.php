<?php
/**
 * Videos.php
 *
 */

namespace GettyImages\Api\Request {

    /**
     * Videos
     *
     * Provides the Videos request.
     */
    class Videos extends FluentRequest {

        /**
         * @access private
         */
        private $videoIdsToLookup = array();

        /**
         * Creates a search configured for Videos.
         *
         * @param array $videoIds
         * @throws \Exception
         * @return Videos;
         */
        public function withIds(array $videoIds = null) {
            if(!$videoIds) {
                throw new \Exception('expected $ids parameter to have at least one value');
            }
            
            $this->requestDetails["ids"] = $videoIds;
            
            return $this;
        }

        public function withId($videoId) {
			array_push($this->videoIdsToLookup,$videoId);

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
            $videoIds = $this->videoIdsToLookup;
            
            if(count($videoIds) == 1) {
                $route = "videos/".implode(",", $videoIds);
            } else {
                $route = "videos";
            }

            return $route;
        }

	}
}