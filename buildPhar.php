<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 9/19/14
 * Time: 7:35 AM
 */

require './vendor/autoload.php';

use Phine\Phar\Builder;
use Phine\Phar\Stub;

// create a new Phar instance
$builder = Builder::create('./build/ConnectSDK.phar');

$builder->buildFromDirectory('./src');
$builder->setStub(
    Stub::create()
        ->addRequire('ConnectSDK.php')
        ->mapPhar("ConnectSDK.phar")
        ->selfExtracting()
        ->getStub());