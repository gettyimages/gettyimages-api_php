<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 9/17/14
 * Time: 10:50 AM
 */

namespace GettyImages\ApiClient\Request\Search\Filters\GraphicalStyle {
    require_once("FineArtGraphicalStyle.php");
    require_once("IllustrationGraphicalStyle.php");
    require_once("PhotographyGraphicalStyle.php");

    abstract class GraphicalStyleFilter  {

        public static function Fine_Art() {
            return new FineArtGraphicalStyleFilter();
        }

        public static function Photography() {
            return new PhotographyGraphicalStyleFilter();
        }

        public static function Illustration() {
            return new IllustrationGraphicalStyleFilter();
        }

        abstract function getValue();
    }
}

