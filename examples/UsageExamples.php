<?php
  /**
  * Usage Examples for the Connect SDK
  * @ignore
  */
use GettyImages\Connect\ConnectSDK;

include realpath(__DIR__.'/../php/build/ConnectSDK.phar');

ini_set('display_errors', 'On');

  //putenv("ConnectSDK_UseProxy=127.0.0.1:8888");
  //putenv("ConnectSDK_IgnoreSSLValidation=TRUE");

  //API key and secret are required minimum credentials to use V3
  $apiKey = "";
  $apiSecret = "";

  //If you are a getty partner, you will have a username and password for Resource Owner Credentials
  $username = "";
  $password = "";


  $sdk = new ConnectSDK($apiKey,$apiSecret);

  $search = $sdk->Search()
                ->Images()
                ->Creative()
                ->withPhrase("Kitties!");

  $results = $search->execute();

  prettyPrintResults($results);

  //or
  $sdk = new ConnectSDK($apiKey,$apiSecret,$username,$password);
  $results = $sdk->Search()
                 ->Images()
                 ->Editorial()
                 ->withPhrase("Dogs")
                 ->withResponseField("asset_family")
                 ->withPage(2)
                 ->withPageSize(10)
                 ->execute();

  prettyPrintResults($results);

  /**
   * @ignore
   */
  function prettyPrintResults($results) {
    echo "Search Results:\n".json_encode(json_decode($results,true), JSON_PRETTY_PRINT);
  }


