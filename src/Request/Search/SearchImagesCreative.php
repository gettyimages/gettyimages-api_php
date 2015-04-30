<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 9/17/14
 * Time: 10:42 AM
 */

namespace GettyImages\Api\Request\Search {

    class SearchImagesCreative extends SearchImages {

        /**
         * @ignore
         */
        protected $route = "search/images/creative/";

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