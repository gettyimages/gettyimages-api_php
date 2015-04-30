<?php

namespace GettyImages\Api\Request\Search\Filters\LicenseModel {
    class RightsManagedLicenseModelFilter extends LicenseModelFilter {
        function getValue() {
            return "rightsmanaged";
        }
    }
}

