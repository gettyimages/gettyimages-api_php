<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 9/17/14
 * Time: 11:26 AM
 */

namespace GettyImages\Connect\Request\Search\Filters\LicenseModel;

class RoyaltyFreeLicenseModelFilter extends LicenseModelFilter {
    public function getValue() {
        return "royalty_free";
    }
}