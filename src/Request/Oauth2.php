<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 9/18/14
 * Time: 7:21 AM
 */
namespace GettyImages\Connect\Request {

    class Oauth2 extends FluentRequest
    {

        /**
         * @return string
         */
        protected function getRoute()
        {
            return "oauth2/token";
        }
    }
}