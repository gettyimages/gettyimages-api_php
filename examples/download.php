#!/usr/bin/env php
<?php
    require '../vendor/autoload.php';
    use GettyImages\Api\GettyImages_Client;

    $apiKey = "API_KEY";
    $apiSecret = "API_SECRET";
    $user = "USER";
    $password = "PASSWORD";

    // Make a call to get the download URI for an image
    $client = GettyImages_Client::getClientWithResourceOwnerCredentials("$apiKey", "$apiSecret", "$user", "$password");
    $response = $client->DownloadImage()->withId(979081604)->execute();
    $payload = json_decode($response, true);
    print ($payload["uri"] . "\n");
