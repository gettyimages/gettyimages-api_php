<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 9/17/14
 * Time: 10:45 AM
 */

namespace GettyImages\ApiClient\Request\Search\Filters\Orientation {

    require_once('HorizontalOrientationFilter.php');
    require_once('PanoramicHorizontalOrientationFilter.php');
    require_once('PanoramicVerticalOrientationFilter.php');
    require_once('SquareOrientationFilter.php');
    require_once('VerticalOrientationFilter.php');

    abstract class OrientationFilter {
        public static function Horizontal() {
            return new HorizontalOrientationFilter();
        }

        public static function Panoramic_Horizontal() {
            return new PanoramicHorizontalOrientationFilter();
        }

        public static function Panoramic_Vertical() {
            return new PanoramicVerticalOrientationFilter();
        }

        public static function Square() {
            return new SquareOrientationFilter();
        }

        public static function Vertical() {
            return new VerticalOrientationFilter();
        }

        abstract function getValue();
    }
}



