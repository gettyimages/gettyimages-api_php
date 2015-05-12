<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

use GettyImages\Api\GettyImages_Client;

class AuthenticationContext  extends BaseContext {

    protected $accessTokenResponse = null;
    protected $refreshToken = null;

    /**
     * @Given a refresh token
     */
    public function aRefreshToken()
    {
        //$this->refreshToken = $this->getEnvValueAndThrowIfNotSet("GettyImagesApi_RefreshToken");

        $envToGetKeyFrom = "GettyImagesApi_UserName";
        $username = $this->getEnvValueAndThrowIfNotSet($envToGetKeyFrom);

        $envToGetKeyFrom = "GettyImagesApi_UserPassword";
        $password = $this->getEnvValueAndThrowIfNotSet($envToGetKeyFrom);

        $sdk = new GettyImages_Client(
            $this->sharedContext->apiKey,
            $this->sharedContext->apiSecret,
            $username,
            $password,
            null);

        $this->accessTokenResponse = $sdk->getAccessToken();
        $this->refreshToken = $this->accessTokenResponse['refresh_token'];
    }


	/**
     * @When /^I ask the sdk for an authentication token$/
     */
    public function iAskTheSdkForAnAuthenticationToken()
    {
        $sdk = $this->sharedContext->getSDK();
        
        $response = $sdk->getAccessToken();

        $this->accessTokenResponse = $response;

    }

    /**
     * @When I request an access token
     */
    public function iRequestAnAccessToken()
    {
        $sdk = $this->sharedContext->getSDK();
        $this->accessTokenResponse = $sdk->getAccessToken();
    }

    /**
     * @Then /^a token is returned$/
     */
    public function aTokenIsReturned() {
        $tokenResponse = $this->accessTokenResponse;

        $this->assertTrue($tokenResponse != null);

        $this->assertTrue(array_key_exists("access_token", $tokenResponse), "access_token was not present in the response");
        $this->assertTrue(array_key_exists("token_type", $tokenResponse), "token_type  was not present in the response");
        $this->assertTrue(array_key_exists("expires_in", $tokenResponse), "expires_in  was not present in the response");

        $this->assertTrue($tokenResponse["token_type"] == "Bearer", "expected Bearer token_type");
        $this->assertTrue($tokenResponse["expires_in"] == "1800");
    }

    /**
     * @Then an access token is returned
     */
    public function anAccessTokenIsReturned()
    {
        $this->assertTrue($this->accessTokenResponse != null);
        $this->assertTrue($this->accessTokenResponse != "");
    }


    private function getEnvValueAndThrowIfNotSet($envKey) {
        if(!getenv($envKey)) {
            throw new \Exception("Environment var: ".$envKey." was not found in the environment");
        }

        return getenv($envKey);
    }
}
