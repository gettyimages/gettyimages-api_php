# Using the SDK via PHP composer

### Assumptions

1. PHP is setup and configured correctly
1. Composer is setup on your machine (Either globally or locally). This readme won't go into the specifics. But [Composer](https://getcomposer.org/doc/01-basic-usage.md) has a good writeup

### Empty Project

Create composer.json with these contents

    {
      "require": {
	       "gettyimages/gettyimages-api": "dev-master"
      }
    }

Run the following command

    composer install

Create your .php file

    <?php
      require 'vendor/autoload.php';
      use GettyImages\Api\GettyImages_Client;

      $apiKey = "myApiKey";
      $apiSecret = "myApiSecret";

      $client = new GettyImages_Client($apiKey,$apiSecret);

      $response = $client->Search()->Images()->withPhrase("dog")->execute();

      var_dump($response);

### Already established Project

    composer require gettyimages/gettyimages-api
