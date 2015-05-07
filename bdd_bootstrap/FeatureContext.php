<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Behat\Context\SnippetAcceptingContext;

include __DIR__."/../build/GettyImagesApi.phar";

use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Request\Search\Filters\GraphicalStyleFilter;
use GettyImages\Api\Request\Search\Filters\LicenseModelFilter;
use GettyImages\Api\Request\Search\Filters\OrientationFilter;
use GettyImages\Api\Request\Search\Filters\NumberOfPeopleFilter;
use GettyImages\Api\Request\Search\Filters\AgeOfPeopleFilter;
use GettyImages\Api\Request\Search\Filters\EditorialSegmentFilter;
use GettyImages\Api\Request\Search\Filters\EthnicityFilter;
use GettyImages\Api\Request\Search\Filters\FileTypeFilter;
use GettyImages\Api\Request\Search\Filters\CompositionFilter;

abstract class SharedCredentials {
    protected $apiKey;
    protected $apiSecret;
    protected $sdk = null;
    protected $username = null;
    protected $password = null;
    protected $refreshToken = null;
  
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

    function assertTrue($bool, $message = NULL) {
        if(!$bool) {
            $errorMessage = "Error: Expected True but was False\n";

            if($message) {
                $errorMessage = $errorMessage . "Message: " . $message;
            }

            throw new \Exception($errorMessage);
        }
    }
}

class FeatureContext implements Context, SnippetAcceptingContext {
    private $availableContexts;
    protected $useSandboxCredentials = false;

    /** @BeforeScenario */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        $environment = $scope->getEnvironment();

        $subContexts = array('AuthenticationContext', 
            'CollectionsContext', 
            'CountriesContext',
            'DownloadsContext', 
            'ImagesContext', 
            'ImageSearchContext');

        $this->availableContexts = array();

        foreach ($subContexts as $subContext) {
            array_push($this->availableContexts, $environment->getContext($subContext));
        }
    }


    /**
     * @Given /^I have an apikey$/
     */
    function givenIHaveAnAPIKey() {

        $envToGetkeyFrom = "GettyImagesApi_ApiKey";

        if($this->useSandboxCredentials) {
            $envToGetkeyFrom = "GettyImagesApi_SandboxApiKey";
        }

        $apiKey = $this->getEnvValueAndThrowIfNotSet($envToGetkeyFrom);

        foreach ($this->availableContexts as $subContext) {
            $subContext->setApiKey($apiKey);
        }
    }

    /**
     * @Given an apisecret
     */
    function anApisecret() {

        $envToGetkeyFrom = "GettyImagesApi_ApiSecret";

        if($this->useSandboxCredentials) {
            $envToGetkeyFrom = "GettyImagesApi_SandboxApiSecret";
        }

        $apiSecret = $this->getEnvValueAndThrowIfNotSet($envToGetkeyFrom);

        foreach ($this->availableContexts as $subContext) {
            $subContext->setApiSecret($apiSecret);
        }
    }

    /**
     * @Given /^a username$/
     */
    public function givenAUsername()
    {
        $envToGetKeyFrom = "GettyImagesApi_UserName";

        if($this->useSandboxCredentials) {
            throw new \Exception("Currently configured for sandbox credentials, should not be sending in a username");
        }

        $username = $this->getEnvValueAndThrowIfNotSet($envToGetKeyFrom);

        foreach ($this->availableContexts as $subContext) {
            $subContext->setUsername($username);
        }
    }

    /**
     * @Given /^a password$/
     */
    public function givenAPassword()
    {
        $envToGetKeyFrom = "GettyImagesApi_UserPassword";

        if($this->useSandboxCredentials) {
            throw new \Exception("Currently configured for sandbox credentials, should not be sending in a password");
        }

        $password = $this->getEnvValueAndThrowIfNotSet($envToGetKeyFrom);

        foreach ($this->availableContexts as $subContext) {
            $subContext->setPassword($password);
        }
    }

    private function getEnvValueAndThrowIfNotSet($envKey) {
        if(!getenv($envKey)) {
            throw new \Exception("Environment var: ".$envKey." was not found in the environment");
        }

        return getenv($envKey);
    }
}