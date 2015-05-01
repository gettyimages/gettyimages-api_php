<?php

namespace GettyImages\Api\Request\Search\Filters {

    abstract class EthnicityFilter {
        public static function Black() {
            return new BlackEthnicityFilter();
        }

        public static function Caucasian() {
            return new CaucasianEthnicityFilter();
        }
        
        public static function East_Asian() {
            return new EastAsianEthnicityFilter();
        }
        
        public static function Hispanic_Latino() {
            return new HispanicLatinoEthnicityFilter();
        }  
        
        public static function Japanese() {
            return new JapaneseEthnicityFilter();
        }
        
        public static function Middle_Eastern() {
            return new MiddleEasternEthnicityFilter();
        }  
        
        public static function Mixed_Race_Person() {
            return new MixedRacePersonEthnicityFilter();
        }
        
        public static function Multiethnic_Group() {
            return new MultiethnicGroupEthnicityFilter();
        }
        
        public static function Native_American_First_Nations() {
            return new NativeAmericanFirstNationsEthnicityFilter();
        }
        
        public static function Pacific_Islander() {
            return new PacificIslanderEthnicityFilter();
        }  
        
        public static function South_Asian() {
            return new SouthAsianEthnicityFilter();
        }
        
        public static function Southeast_Asian() {
            return new SoutheastAsianEthnicityFilter();
        }                  
        
        public abstract function getValue(); 
    }
    
    
    
    class BlackEthnicityFilter extends EthnicityFilter {
        public function getValue() {
            return "black";            
        }
    }    
    
    class CaucasianEthnicityFilter extends EthnicityFilter {
        public function getValue() {
            return "caucasian";            
        }
    }    

    class EastAsianEthnicityFilter extends EthnicityFilter {
        public function getValue() {
            return "east_asian";            
        }
    }
    
    class HispanicLatinoEthnicityFilter extends EthnicityFilter {
        public function getValue() {
            return "hispanic_latino";            
        }
    }
    
    class JapaneseEthnicityFilter extends EthnicityFilter {
        public function getValue() {
            return "japanese";            
        }
    }
    
    class MiddleEasternEthnicityFilter extends EthnicityFilter {
        public function getValue() {
            return "middle_eastern";            
        }
    } 
    
    class MixedRacePersonEthnicityFilter extends EthnicityFilter {
        public function getValue() {
            return "mixed_race_person";            
        }
    }
    
    class MultiethnicGroupEthnicityFilter extends EthnicityFilter {
        public function getValue() {
            return "multiethnic_group";            
        }
    }    
    
    class NativeAmericanFirstNationsEthnicityFilter extends EthnicityFilter {
        public function getValue() {
            return "native_american_first_nations";            
        }
    } 
    
    class PacificIslanderEthnicityFilter extends EthnicityFilter {
        public function getValue() {
            return "pacific_islander";            
        }
    } 
    
    class SouthAsianEthnicityFilter extends EthnicityFilter {
        public function getValue() {
            return "south_asian";            
        }
    } 
    
    class SoutheastAsianEthnicityFilter extends EthnicityFilter {
        public function getValue() {
            return "southeast_asian";            
        }
    }      
}