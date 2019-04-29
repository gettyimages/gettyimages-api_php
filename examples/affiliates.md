# Sample code for use by affiliates

### Search for creative images and return referral_destinations, title and preview
```php
<?php
    require 'vendor/autoload.php';
	use GettyImages\Api\GettyImages_Client;

	$apiKey = "API_KEY";
	$apiSecret = "API_SECRET";

	//Example of built in search images endpoint
	$client = GettyImages_Client::getClientWithClientCredentials("$apiKey", "$apiSecret");
    $fields = array("referral_destinations", "title", "preview");
	$response = $client->SearchImagesCreative()->withPhrase("cat")->withFields($fields)->withPageSize(5)->execute();

    print ($response);
```