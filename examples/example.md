		<?php

		include __DIR__.'/build/ConnectSDK.phar';

		use GettyImages\Connect\ConnectSDK;

		$apiKey = "myApiKey";
		$apiSecret = "myApiSecret";

		$sdk = new ConnectSDK($apiKey,$apiSecret);

		$response = $sdk->Search()->Images()->withPhrase("dog")->execute();

		var_dump($response);
