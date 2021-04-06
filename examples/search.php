#!/usr/bin/env php

<?php

require '../vendor/autoload.php';
use GettyImages\Api\GettyImages_Client;

$apiKey = "API_KEY";
$apiSecret = "API_SECRET";
$user = "USER";
$password = "PASSWORD";


$client = GettyImages_Client::getClientWithResourceOwnerCredentials("$apiKey", "$apiSecret", "$user", "$password");
$fields = array("download_sizes", "title", "preview");

$response = $client->SearchImages()->withPhrase("cat")->withFields($fields)->execute();

echo $response;
