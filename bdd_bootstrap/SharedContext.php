<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

use GettyImages\Api\GettyImages_Client;

class SharedContext implements Context, SnippetAcceptingContext {

	public $apiKey;
    public $apiSecret;
    public $sdk = null;
    public $username = null;
    public $password = null;
    public $refreshToken = null;

    public $sharedContextInfo = array();

    public $requestFields = array();
    
    function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
    }

    function setApiSecret($apiSecret) {
        $this->apiSecret = $apiSecret;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @return GettyImages_Client|null
     */
    function getSDK() {        
        $context = $this;

        if(is_null($context->sdk)) {
          
          $context->sdk = new GettyImages_Client(
            $context->apiKey,
            $context->apiSecret,
            $context->username,
            $context->password,
            $context->refreshToken);

          return $context->sdk;
        }

        return $context->sdk;
    }
}