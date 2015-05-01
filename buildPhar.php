<?php
require './vendor/autoload.php';

use Phine\Phar\Builder;
use Phine\Phar\Stub;

// create a new Phar instance
$builder = Builder::create('./build/GettyImagesApi.phar');

$builder->buildFromDirectory('./src');
$builder->setStub(
    Stub::create()
        ->addRequire('GettyImages_Client.php')
        ->mapPhar("GettyImagesApi.phar")
        ->selfExtracting()
        ->getStub());