<?php

namespace GettyImages\Api\Request\Search {

    use GettyImages\Api\Request\Search\Filters\EditorialSegmentFilter;

    class SearchImagesEditorial extends SearchImages {

        /**
         * @ignore
         */
        protected $route = "search/images/editorial/";

        /**
         * Gets the route configuration of the current search
         *
         * @return string The relative route for this request type
         */
        public function getRoute() {
            return $this->route;
        }

        /**
         * Sets the editorial segments to search for
         * @param EditorialSegmentFilter $editorialSegmentName
         * @throws \Exception
         * @return $this
         */
        public function withEditorialSegment(EditorialSegmentFilter $editorialSegmentName) {
            $this->appendArrayValueToRequestDetails("editorial_segments",$editorialSegmentName->getValue());
            return $this;
        }
    }
}
