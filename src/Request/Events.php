<?php
/**
 * Events.php
 *
 */

namespace GettyImages\Api\Request {

    /**
     * Events
     *
     * Provides the Events request.
     */
    class Events extends FluentRequest {
    
        /**
         * @access private
         */
        private $eventIdsToLookup = array();

        public function withId($eventId) {
            array_push($this->eventIdsToLookup,$eventId);
            return $this;
        }

        public function withIds(array $eventIds) {
            $this->eventIdsToLookup = $eventIds;
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
            $eventIds = $this->eventIdsToLookup;
            
            if(count($eventIds) == 1) {
                $route = "events/".implode(",", $eventIds);
            } else if (count($eventIds) > 1) {
                $route = "events/?ids=".implode(",", $eventIds);
            } else {
                $route = "events";
            }

            return $route;
        }
    }
}
