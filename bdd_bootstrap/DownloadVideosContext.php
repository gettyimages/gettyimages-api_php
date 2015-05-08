<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

class DownloadVideosContext extends SharedCredentials implements Context, SnippetAcceptingContext {

    protected $downloadResponse = null;
    protected $downloadParameters = array();
    protected $videoIdToDownload = "158885355";

    /**                                                                                                                                                                               
     * @Given a download size                                                                                                                                                           
     */                                                                                                                                                                               
    public function aDownloadSize()                                                                                                                                                    
    {                                
        $this->downloadParameters["size"] = "sws";                                                                                                                                        
    }

    /**
     * @When /^I request for any video to be downloaded$/
     */
    public function iRequestForAnyVideoToBeDownloaded()
    {
        $context = $this;
        $downloadSdk = $this->getSDK()->Download()->Video();
        
        if (array_key_exists("size", $context->downloadParameters)) {
            $downloadSdk = $downloadSdk->withSize($context->downloadParameters["size"]);
        }

        try {
            $videoIdToDownload = $context->videoIdToDownload;
            $response = $downloadSdk->withId($videoIdToDownload)->execute();
            $context->downloadResponse = $response;
        } catch (Exception $e) {
            $context->downloadResponse = $e;
        }
    }

    /**
     * @Then /^the url for the video is returned$/
     *
     */
    public function theUrlfortheVideoIsReturned() {
        $downloadResponse = json_decode($this->downloadResponse,true);

        $this->assertTrue(strpos($downloadResponse["uri"], "https://delivery.gettyimages.com/xa/".$this->videoIdToDownload) === 0,"Download Response was not pointing to correct location");
    }

    /**
     * @Then I receive an exception
     */
    public function iReceiveAnException()
    {
        $response = null;

        $response = $this->downloadResponse;

        $this->assertTrue(is_a($response,'Exception',true), "Expected Response Object to be an exception");
    }


    /**
     * @Then I receive not authorized message
     */
    public function iReceiveNotAuthorizedMessage()
    {
        $response = $this->downloadResponse;
        $msg = $response->getMessage();

        $this->assertTrue(strpos($msg, "AuthorizationTokenRequired") === 0,"Download Response should contain AuthorizationTokenRequired message (401)");
    }

    


}
