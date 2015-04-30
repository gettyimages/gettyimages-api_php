		<?php

		include __DIR__.'/build/GettyImagesApi.phar';

		use GettyImages\Api\GettyImages_Client;

		$apiKey = "myApiKey";
		$apiSecret = "myApiSecret";

		$sdk = new GettyImages_Client($apiKey,$apiSecret);

		$response = $sdk->Search()->Images()->withPhrase("dog")->execute();

		var_dump($response);
