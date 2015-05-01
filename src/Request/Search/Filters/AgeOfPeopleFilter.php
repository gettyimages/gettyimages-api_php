<?php
namespace GettyImages\Api\Request\Search\Filters {

    abstract class AgeOfPeopleFilter {
        
        public static function Newborn() {
            return new SpecificAgeFilter("newborn");
        }

        public static function Baby() {
            return new SpecificAgeFilter("baby");
        }
        
        public static function Child() {
            return new SpecificAgeFilter("child");
        }
        
        public static function Teenager() {
            return new SpecificAgeFilter("teenager");
        }   
        
        public static function Adult() {                       
            return new SpecificAgeFilter("adult");
        }
        
        public static function Young_Adult() {                       
            return new SpecificAgeFilter("young_adult");
        }        
        
        public static function Adults_Only() {
            return new SpecificAgeFilter("adults_only");
        }
        
        public static function Mature_Adult() {
            return new SpecificAgeFilter("mature_adult");
        }
        
        public static function Senior_Adult() {
            return new SpecificAgeFilter("senior_adult");
        }
        
        public static function ZeroToOne_Months() {
            return new SpecificAgeFilter("0-1_months");
        }
        
        public static function TwoToFive_Months() {
            return new SpecificAgeFilter("2-5_months");
        }
        
        public static function SixToEleven_Months() {
            return new SpecificAgeFilter("6-11_months");
        }
        
        public static function TwelveToSeventeen_Months() {
            return new SpecificAgeFilter("12-17_months");
        }
        
        public static function EighteenToTwentyThree_Months() {
            return new SpecificAgeFilter("18-23_months");
        }
        
        public static function TwoToThree_Years() {
            return new SpecificAgeFilter("2-3_years");
        }
        
        public static function ThreeToFour_Years() {
            return new SpecificAgeFilter("3-4_years");
        }
        
        public static function FourToFive_Years() {
            return new SpecificAgeFilter("4-5_years");
        }
        
        public static function SixToSeven_Years() {
            return new SpecificAgeFilter("6-7_years");
        }
        
        public static function EightToNine_Years() {
            return new SpecificAgeFilter("8-9_years");
        }
        
        public static function TenToEleven_Years() {
            return new SpecificAgeFilter("10-11_years");
        }
        
        public static function TwelveToThirteen_Years() {
            return new SpecificAgeFilter("12-13_years");
        }
        
        public static function FourteenToFifteen_Years() {
            return new SpecificAgeFilter("14-15_years");
        }
        
        public static function SixteenToSeventeen_Years() {
            return new SpecificAgeFilter("16-17_years");
        }
        
        public static function EighteenToNineteen_Years() {
            return new SpecificAgeFilter("18-19_years");
        }
        
        public static function TwentyToTwentyFour_Years() {
            return new SpecificAgeFilter("20-24_years");
        }
        
        public static function TwentyToTwentyNine_Years() {
            return new SpecificAgeFilter("20-29_years");
        }
        
        public static function TwentyFiveToTwentyNine_Years() {
            return new SpecificAgeFilter("25-29_years");
        }
        
        public static function ThirtyToThirtyFour_Years() {
            return new SpecificAgeFilter("30-34_years");
        }
        
        public static function ThirtyToThirtyNine_Years() {
            return new SpecificAgeFilter("30-39_years");
        }
        
        public static function ThirtyFiveToThirtyNine_Years() {
            return new SpecificAgeFilter("35-39_years");
        }
        
        public static function FortyToFortyFour_Years() {
            return new SpecificAgeFilter("40-44_years");
        }
        
        public static function FortyToFortyNine_Years() {
            return new SpecificAgeFilter("40-49_years");
        }
        
        public static function FortyFiveToFortyNine_Years() {
            return new SpecificAgeFilter("45-49_years");
        }      
        
        public static function FiftyToFiftyFour_Years() {
            return new SpecificAgeFilter("50-54_years");
        }
        
        public static function FiftyToFiftyNine_Years() {
            return new SpecificAgeFilter("50-59_years");
        }
        
        public static function FiftyFiveToFiftyNine_Years() {
            return new SpecificAgeFilter("55-59_years");
        }   
        
        public static function SixtyToSixtyFour_Years() {
            return new SpecificAgeFilter("60-64_years");
        }
        
        public static function SixtyToSixtyNine_Years() {
            return new SpecificAgeFilter("60-69_years");
        }
        
        public static function SixtyFiveToSixtyNine_Years() {
            return new SpecificAgeFilter("65-69_years");
        }
                
        public static function SeventyToSeventyFour_Years() {
            return new SpecificAgeFilter("70-74_years");
        }
        
        public static function SeventyToSeventyNine_Years() {
            return new SpecificAgeFilter("70-79_years");
        }
        
        public static function SeventyFiveToSeventyNine_Years() {
            return new SpecificAgeFilter("75-79_years");
        }            
        
        public static function EightyToEightyFour_Years() {
            return new SpecificAgeFilter("80-84_years");
        }
        
        public static function EightyToEightyNine_Years() {
            return new SpecificAgeFilter("80-89_years");
        }       
        
        public static function NinetyPlus_Years() {
            return new SpecificAgeFilter("90_plus_years");
        }
        
        public static function OneHundredAndOver_Years () {
            return new SpecificAgeFilter("100_over");
        }        
        
        public abstract function getValue();                
    }    
    
    class SpecificAgeFilter extends AgeOfPeopleFilter {
       private $age; 
        
       function __construct($age) {
           $this->age = $age;
       }

       public function getValue() {
           return $this->age;            
       }
    }
}
