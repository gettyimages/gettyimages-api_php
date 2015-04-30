		<?php

		include __DIR__.'/build/ApiClient.phar';

		use GettyImages\ApiClient\GettyImages_Client;

		$apiKey = "myApiKey";
		$apiSecret = "myApiSecret";

		$sdk = new GettyImages_Client($apiKey,$apiSecret);

		$response = $sdk->Search()->Images()->withPhrase("dog")->execute();

		var_dump($response);
