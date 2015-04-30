<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 9/17/14
 * Time: 11:19 AM
 */

namespace GettyImages\ApiClient\Request\Search\Filters\Orientation;

class PanoramicHorizontalOrientationFilter extends OrientationFilter {

    function getValue()
    {
        return "panoramic_horizontal";
    }
}