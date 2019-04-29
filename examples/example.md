```php
<?php

include __DIR__.'/build/GettyImagesApi.phar';

use GettyImages\Api\GettyImages_Client;

$apiKey = "myApiKey";
$apiSecret = "myApiSecret";

$types = array("easyaccess", "editorialsubscription");

//Example of built in search images endpoint
$client = GettyImages_Client::getClientWithClientCredentials("$apiKey", "$apiSecret");

$response = $client->SearchImages()->withPhrase("cat")->withProductTypes($types)->execute();

var_dump($response);



//Example of custom request for artists images endpoint
$params = array("artist_name" => "roman makhmutov", "page" => 3, "page_size" => 50);

$client = GettyImages_Client::getClientWithClientCredentials("$apiKey", "$apiSecret");

$response = $client->CustomRequest()->WithRoute("artists/images")->withMethod("get")->withQueryParameters($params)->execute();

var_dump($response);
```
