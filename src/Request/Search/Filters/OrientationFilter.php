<?php
namespace GettyImages\Api\Request\Search\Filters {

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

    class HorizontalOrientationFilter extends OrientationFilter 
    {
        function getValue()
        {
            return "horizontal";
        }
    }

    class PanoramicHorizontalOrientationFilter extends OrientationFilter 
    {
        function getValue()
        {
            return "panoramic_horizontal";
        }
    }

    class PanoramicVerticalOrientationFilter extends OrientationFilter 
    {
        function getValue()
        {
            return "panoramic_vertical";
        }
    }

    class SquareOrientationFilter extends OrientationFilter 
    {
        function getValue()
        {
            return "square";
        }
    }

    class VerticalOrientationFilter extends OrientationFilter 
    {
        function getValue()
        {
            return "vertical";
        }
    }

}