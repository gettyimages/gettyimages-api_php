<?php
require './vendor/autoload.php';

use Phine\Phar\Builder;
use Phine\Phar\Stub;

// create a new Phar instance
$builder = Builder::create('./build/ApiClient.phar');

$builder->buildFromDirectory('./src');
$builder->setStub(
    Stub::create()
        ->addRequire('ApiClient.php')
        ->mapPhar("ApiClient.phar")
        ->selfExtracting()
        ->getStub());