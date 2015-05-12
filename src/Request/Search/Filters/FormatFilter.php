<?php

namespace GettyImages\Api\Request\Search\Filters {

    abstract class FormatFilter {

        public static function Sd() {
            return new SdFormatFilter();
        }

        public static function Hd() {
            return new HdFormatFilter();
        }

        public abstract function getValue(); 
    }
    
    class SdFormatFilter extends FormatFilter {
        public function getValue() {
            return "sd";            
        }
    }

    class HdFormatFilter extends FormatFilter {
        public function getValue() {
            return "hd";
        }
    }
}
