#!/usr/bin/env php

<?php

require '../vendor/autoload.php';
use GettyImages\Api\GettyImages_Client;

$apiKey = "API_KEY";

$client = GettyImages_Client::getClientWithApiKey("$apiKey");
$fields = array("download_sizes", "title", "preview");

$response = $client->SearchImages()->withPhrase("cat")->withFields($fields)->execute();

echo $response;
