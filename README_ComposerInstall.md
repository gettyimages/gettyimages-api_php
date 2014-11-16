# Using the SDK via PHP composer

### Assumptions

1. PHP is setup and configured correctly
1. Composer is setup on your machine (Either globally or locally). This readme won't go into the specifics. But [Composer](https://getcomposer.org/doc/01-basic-usage.md) has a good writeup

### Empty Project

Create composer.json with these contents

    {
      "require": {
	       "gettyimages/connect_sdk": "dev-master"
      }
    }

Run the following command

    composer install

Create your .php file

    <?php
      require 'vendor/autoload.php';
      use GettyImages\Connect\ConnectSDK;

      $apiKey = "myApiKey";
      $apiSecret = "myApiSecret";

      $sdk = new ConnectSDK($apiKey,$apiSecret);

      $response = $sdk->Search()->Images()->withPhrase("dog")->execute();

      var_dump($response);

### Already established Project

    composer require gettyimages/connect_sdk
