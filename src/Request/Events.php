<?php

namespace GettyImages\Api\Request {

    class Events extends FluentRequest {
    
        /**
         * @access private
         */
        private $eventIdsToLookup = array();

        /**
         * @ignore
         */
        protected $route = "events/";

        protected function getRoute() {
            $eventIds = $this->eventIdsToLookup;
            
            if(count($eventIds) == 1) {
                $this->route = $this->route.implode(",", $eventIds);
            } else if (count($eventIds) > 1) {
                $this->addArrayOfValuesToRequestDetails("ids", $eventIds);
            }

            return $this->route;
        }

        protected function getMethod() {
            return "get";
        }

        /**
         * @param int $eventId
         * @return $this
         */
        public function withId(int $eventId) {
            array_push($this->eventIdsToLookup,$eventId);
            return $this;
        }

         /**
         * @param array $eventIds
         * @return $this
         */
        public function withIds(array $eventIds) {
            $this->eventIdsToLookup = $eventIds;
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
