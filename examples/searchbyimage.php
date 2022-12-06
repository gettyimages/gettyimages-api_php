#!/usr/bin/env php

<?php
require '../vendor/autoload.php';
use GettyImages\Api\GettyImages_Client;

$apiKey = "API_KEY";
$apiSecret = "API_SECRET";
$user = "USER";
$password = "PASSWORD";

$client = GettyImages_Client::getClientWithResourceOwnerCredentials("$apiKey", "$apiSecret", "$user", "$password");

//Upload image to bucket and search:
$filename = "testimage.jpg";
$filepath = "filepath/to/testimage.jpg";

$uploadedImageResponse = $client->SearchImagesCreativeByImage()->addToBucketAndSearchAsync($filename, $filepath)->execute();

echo $uploadedImageResponse;

//Search by GettyImages asset id:
$assetId = "1194409229";

$assetIdResponse = $client->SearchImagesCreativeByImage()->withAssetId($assetId)->execute();

echo $assetIdResponse;
