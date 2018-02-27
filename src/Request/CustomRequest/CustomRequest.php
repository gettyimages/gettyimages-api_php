<?php

namespace GettyImages\Api\Request\CustomRequest {

    
    use GettyImages\Api\Request\FluentRequest;
    use GettyImages\Api\Request\WebHelper;

    class CustomRequest extends FluentRequest {

        /**
         * @ignore
         */
        protected $route;

        /**
         * @ignore
         */
        protected $method;

        protected function getRoute() {
            return $this->route;
        }
        
        protected function getMethod() {
            return $this->method;
        }

        /**
         * @param string $route The route to append to "https://api.gettyimages.com/v3"
         * @return $this
         */
        public function withRoute($route) {
            $this->route = $route;
            return $this;
        }

        /**
         * @param string $method The type HTTP method - get, post, put, or delete
         * @throws \Exception If the method is not get, post, put, or delete an exception will be thrown
         * @return $this
         */
        public function withMethod($method) {
            $this->method = $method;
            return $this;
        }

        /**
         * @param array $parameters An array of key => value pairs where the key is the name of the parameter and the value is the associated value(s)
         * The value for each key can be a single value or an array of values
         * @return $this
         */
        public function withQueryParameters(array $parameters) {
            $this->requestDetails = $parameters;
            return $this;
        }

        /**
         * @param array $parameters An array of key => value pairs where the key is the name of the parameter and the value is the associated value(s)
         * The value for each key can be a single value or an array of values
         * @return $this
         */
        public function withBody(array $data) {
            $this->data = $data;
            return $this;
        }
    }

}