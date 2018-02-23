<?php

namespace GettyImages\Api\Request {

     class Countries extends FluentRequest {

        protected function getRoute() {
            return "countries";
        }

        protected function getMethod() {
            return "get";
        }

        //ACCEPT LANG
    }
}
