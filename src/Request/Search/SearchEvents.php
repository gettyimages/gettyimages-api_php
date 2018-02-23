<?php

namespace GettyImages\Api\Request\Search {

    use GettyImages\Api\Request\FluentRequest;
    use GettyImages\Api\Request\WebHelper;
    use Exception;

    class SearchEvents extends FluentRequest {

        /**
         * @ignore
         */
        protected $route = "search/events/";

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
         * @param string $dateFrom
         * @return $this
         */
        public function withDateFrom(string $dateFrom) {
            $this->requestDetails["date_from"] = $dateFrom;
            return $this;
        }

        /**
         * @param string $dateTo
         * @return $this
         */
        public function withDateTo(string $dateTo) {
            $this->requestDetails["date_to"] = $dateTo;
            return $this;
        }

        /**
         * @param string $editorialsegment
         * @return $this
         */
        public function withEditorialSegment(string $editorialSegment) {
            $this->requestDetails["editorial_segment"] = $editorialSegment;
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

        /**
         * @param string $phrase
         * @return $this
         */
        public function withPhrase(string $phrase) {
            $this->requestDetails["phrase"] = $phrase;

            return $this;
        }
    }
}
