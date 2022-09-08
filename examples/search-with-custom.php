#!/usr/bin/env php

<?php

require dirname(__DIR__, 1).'/vendor/autoload.php';
use GettyImages\Api\GettyImages_Client;

$apiKey = "API_KEY";
$apiSecret = "API_SECRET";

$client = GettyImages_Client::getClientWithClientCredentials("$apiKey", "$apiSecret");
$fields = array("title", "preview");

$response = $client->SearchImagesCreative()->
    withPhrase("cat")->
    withFields($fields)->
    withCustomParameter("safe_search", "true")->
    withCustomHeader("gi-country-code", "ABW")->execute();

echo $response;
