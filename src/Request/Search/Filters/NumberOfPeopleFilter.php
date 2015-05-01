<?php

namespace GettyImages\Api\Request\Search\Filters {

    abstract class NumberOfPeopleFilter {
        public static function None() {
            return new NoPeopleFilter();
        }

        public static function One() {
            return new OnePersonFilter();
        }
        
        public static function Two() {
            return new TwoPeopleFilter();
        }
        
        public static function Group() {
            return new GroupOfPeopleFilter();
        }        

        public abstract function getValue(); 
    }
    
    
    class NoPeopleFilter extends NumberOfPeopleFilter {
        public function getValue() {
            return "none";            
        }
    }
    
    class OnePersonFilter extends NumberOfPeopleFilter {
        public function getValue() {
            return "one";            
        }
    }
    
    class TwoPeopleFilter extends NumberOfPeopleFilter {
        public function getValue() {
            return "two";            
        }
    }
    
    class GroupOfPeopleFilter extends NumberOfPeopleFilter {
        public function getValue() {
            return "group";            
        }
    }    
}