<?php

namespace GettyImages\Api\Request\Search\Filters {

    abstract class CollectionFilter {

        public static function Include() {
            return new IncludeCollectionFilter();
        }

        public static function Exclude() {
            return new ExcludeCollectionFilter();
        }

        public abstract function getValue(); 
    }
    
    class IncludeCollectionFilter extends CollectionFilter {
        public function getValue() {
            return "include";            
        }
    }

    class ExcluedCollectionFilter extends CollectionFilter {
        public function getValue() {
            return "exclude";
        }
    }
}