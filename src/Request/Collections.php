<?php

namespace GettyImages\Api\Request {

    class Collections extends FluentRequest {

        protected function getRoute() {
            return "collections";
        }

        protected function getMethod() {
            return "get";
        }
    }

}


