<?php
namespace GettyImages\Api\Request\Search\Filters {

    abstract class LicenseModelFilter {
        public static function RightsManaged() {
            return new RightsManagedLicenseModelFilter();
        }

        public static function RoyaltyFree() {
            return new RoyaltyFreeLicenseModelFilter();
        }

        public abstract function getValue();
    }

    class RightsManagedLicenseModelFilter extends LicenseModelFilter 
    {
        function getValue() {
            return "rightsmanaged";
        }
    }   

    class RoyaltyFreeLicenseModelFilter extends LicenseModelFilter 
    {
        public function getValue() {
            return "royaltyfree";
        }
    }  
}