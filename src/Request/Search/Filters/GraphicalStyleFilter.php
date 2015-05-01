<?php
namespace GettyImages\Api\Request\Search\Filters {

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

    class FineArtGraphicalStyleFilter extends GraphicalStyleFilter 
    {
        function getValue()
        {
            return "fine_art";
        }
    }

    class IllustrationGraphicalStyleFilter extends GraphicalStyleFilter 
    {
        public function getValue()
        {
            return "illustration";
        }
    }

    class PhotographyGraphicalStyleFilter extends GraphicalStyleFilter 
    {
        function getValue()
        {
            return "photography";
        }
    }    
}