<?php

namespace GettyImages\Api\Request\Search {

    class SearchVideosCreative extends SearchVideos {

        /**
         * @ignore
         */
        protected $route = "search/videos/creative/";

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