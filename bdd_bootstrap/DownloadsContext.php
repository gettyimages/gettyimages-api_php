<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

class DownloadsContext extends BaseContext {

    protected $downloadParameters = array();

    protected $imageIdToDownload = "464423888";
    protected $imageJpgHeight = 280;
    protected $imageEpsHeight = 4071;
    protected $videoIdToDownload = "158885355";

    protected $downloadResponse = null;

    /**                                                                                                                                                                                                  
     * @Given /^I specify (\w+) file type$/                                                                                                                                                                   
     */                                                                                                                                                                                                  
    public function givenISelectAFileType($fileType)                                                                                                                                                               
    {       
        $this->downloadParameters["fileType"] = $fileType;
        $height = 0;
        if ($fileType === "eps") {
               $height = $this->imageEpsHeight;
           } else {
               $height = $this->imageJpgHeight;
        }
                                                                      
        $this->downloadParameters["height"] = $height; 
    }

    /**                                                                                                                                                                               
     * @Given a pixel height                                                                                                                                                           
     */                                                                                                                                                                               
    public function aPixelHeight()                                                                                                                                                    
    {                                
        $this->downloadParameters["height"] = $this->imageJpgHeight;                                                                                                                                        
    }

    /**                                                                                                                                                                              
     * @Given a download size                                                                                                                                                           
     */                                                                                                                                                                               
    public function aDownloadSize()                                                                                                                                                    
    {                                
        $this->downloadParameters["size"] = "sws";                                                                                                                                        
    }

    /**
     * @When /^I request for any image to be downloaded$/
     */
    public function iRequestForAnyImageToBeDownloaded()
    {
        $context = $this;
        $downloadSdk = $this->sharedContext->getSDK()->Download()->Image();

        if (array_key_exists("fileType", $context->downloadParameters)) {
            $downloadSdk = $downloadSdk->withFileType($context->downloadParameters["fileType"]);
        }
        
        if (array_key_exists("height", $context->downloadParameters)) {
            $downloadSdk = $downloadSdk->withHeight($context->downloadParameters["height"]);
        }

        try {
            $imageIdToDownload = $context->imageIdToDownload;
            $response = $downloadSdk->withId($imageIdToDownload)->execute();
            $context->downloadResponse = $response;
        } catch (Exception $e) {
            $context->downloadResponse = $e;
        }
    }

    /**
     * @When /^I request for any video to be downloaded$/
     */
    public function iRequestForAnyVideoToBeDownloaded()
    {
        $context = $this;
        $downloadSdk = $this->sharedContext->getSDK()->Download()->Video();
        
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
     * @Then /^I receive an error$/
     */
    public function iGetAnError() {
        $response = null;

        $response = $this->downloadResponse;

        $this->assertTrue(is_a($response,'Exception',true), "Expected Response Object to be an exception");
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
     * @Then /^the url has a (\w+) file type/                                                                                                                                              
     */                                                                                                                                                                               
    public function theUrlHasAFileType($fileType){
        $downloadResponse = json_decode($this->downloadResponse,true);
        $this->assertTrue(strpos($downloadResponse["uri"], $fileType) !== 0,"Download is not of correct type");                                                                                                                                                 
    } 

    /**
     * @Then /^the url for the image is returned$/
     *
     */
    public function theUrlfortheImageIsReturned() {
        $downloadResponse = json_decode($this->downloadResponse,true);
        $uri = $downloadResponse["uri"];
        $needle = "https://delivery.gettyimages.com/xa/".$this->imageIdToDownload;
        $found = strpos($downloadResponse["uri"], "https://delivery.gettyimages.com/xa/".$this->imageIdToDownload);
        $this->assertTrue(strpos($downloadResponse["uri"], "https://delivery.gettyimages.com/xa/".$this->imageIdToDownload) === 0,"Download Response was not pointing to correct location");
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
     * @Then I receive not authorized message
     */
    public function iReceiveNotAuthorizedMessage()
    {
        $response = $this->downloadResponse;

        $this->assertTrue(strpos($response->getMessage(), "401") > 0,"Download Response should contain AuthorizationTokenRequired message (401)");
    }
}
