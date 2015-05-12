<?php

namespace GettyImages\Api\Request\Search {

    use GettyImages\Api\Request\Search\Filters\EditorialSegmentFilter;

    class SearchVideosEditorial extends SearchVideos {

        /**
         * @ignore
         */
        protected $route = "search/videos/editorial/";

        /**
         * Gets the route configuration of the current search
         *
         * @return string The relative route for this request type
         */
        public function getRoute() {
            return $this->route;
        }
    }
}
