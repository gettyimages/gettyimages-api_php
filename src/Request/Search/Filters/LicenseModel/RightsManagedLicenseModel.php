<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 9/17/14
 * Time: 11:27 AM
 */

namespace GettyImages\Connect\Request\Search\Filters\LicenseModel;

class RightsManagedLicenseModelFilter extends LicenseModelFilter {
    function getValue() {
        return "rights_managed";
    }
}