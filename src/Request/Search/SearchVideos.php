<?php
/**
 * Contains the implementations of Video Searching
 */

namespace GettyImages\Api\Request\Search {
    
    use Exception;
    use GettyImages\Api\Request\Search\Filters\AgeOfPeopleFilter;
    use GettyImages\Api\Request\Search\Filters\FormatFilter;
    
    /**
     * Provides Video Search specific behavior
     */
    class SearchVideos extends Search {

        /**
         * @ignore
         */
        protected $route = "search/videos/";

        /**
         * Gets the route configuration of the current search
         *
         * @return string The relative route for this request type
         */
        public function getRoute() {
            return $this->route;
        }

        /**
         * Will create a search configuration that support creative only video searching
         *
         * @internal param \GettyImages\SDK\string|string $phrase optionally provide a search phrase, shortcut to calling Phrase()
         * @return SearchVideos Configured for a creative search
         */
        public function Creative() {
            return new SearchVideosCreative($this->credentials,$this->endpointUri,$this->requestDetails);
        }

        /**
         * Will create a search configuration that support editorial only video searching
         *
         * @return SearchVideos Configured for a editorial image search
         */
        public function Editorial() {
            return new SearchVideosEditorial($this->credentials,$this->endpointUri, $this->requestDetails);
        }

        /**
         * @param $formatFilter
         * @return $this
         */
        public function withFormatFilter(FormatFilter $formatFilter) {

            $this->appendArrayValueToRequestDetails("format_available",$formatFilter->getValue());
            return $this;
        }
        
    }
}