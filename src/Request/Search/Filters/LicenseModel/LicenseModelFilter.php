<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 9/17/14
 * Time: 10:50 AM
 */

namespace GettyImages\Connect\Request\Search\Filters\LicenseModel {

    require_once("RightsManagedLicenseModel.php");
    require_once("RoyaltyFreeLicenseModel.php");

    abstract class LicenseModelFilter {
        public static function Rights_Managed() {
            return new RightsManagedLicenseModelFilter();
        }

        public static function Royalty_Free() {
            return new RoyaltyFreeLicenseModelFilter();
        }

        public abstract function getValue();
    }
}