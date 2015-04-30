<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 9/17/14
 * Time: 11:20 AM
 */

namespace GettyImages\ApiClient\Request\Search\Filters\Orientation;

class PanoramicVerticalOrientationFilter extends OrientationFilter {

    function getValue()
    {
        return "panoramic_vertical";
    }
}