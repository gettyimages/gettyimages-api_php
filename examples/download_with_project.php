#!/usr/bin/env php
<?php
    require '../vendor/autoload.php';
    use GettyImages\Api\GettyImages_Client;

    $apiKey = "API_KEY";
    $apiSecret = "API_SECRET";
    $user = "USER";
    $password = "PASSWORD";

    // Make a call to get the download URI for an image while adding notes and project code
    $client = GettyImages_Client::getClientWithResourceOwnerCredentials("$apiKey", "$apiSecret", "$user", "$password");
    $assetId = "1194409229";
    $response = $client->CustomRequest()->
        WithRoute("downloads/images/" . $assetId)->
        withMethod("post")->
        withQueryParameters(array("auto_download" => "false", "product_type" => "premiumaccess"))->
        withBody(array("download_notes" => "Download notes.", "project_code" => "Project XYZ"))->execute();
    $payload = json_decode($response, true);
    print ($payload["uri"] . "\n");
