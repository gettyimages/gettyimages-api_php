<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 9/17/14
 * Time: 11:21 AM
 */

namespace GettyImages\ApiClient\Request\Search\Filters\Orientation;

class SquareOrientationFilter extends OrientationFilter {

    function getValue()
    {
        return "square";
    }
}