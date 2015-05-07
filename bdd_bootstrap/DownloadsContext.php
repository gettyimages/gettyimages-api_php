<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

class DownloadsContext extends SharedCredentials implements Context, SnippetAcceptingContext {

    protected $downloadResponse = null;
    protected $downloadParameters = array();
    protected $imageIdToDownload = "165375606";

    /**                                                                                                                                                                                                  
     * @Given /^I specify (\w+) file type$/                                                                                                                                                                   
     */                                                                                                                                                                                                  
    public function givenISelectAFileType($fileType)                                                                                                                                                               
    {       
        $this->downloadParameters["fileType"] = $fileType;
    }

    /**                                                                                                                                                                               
     * @Given a pixel height                                                                                                                                                           
     */                                                                                                                                                                               
    public function aPixelHeight()                                                                                                                                                    
    {                                
        $this->downloadParameters["height"] = 2277;                                                                                                                                        
    }

    /**
     * @When /^I request for any image to be downloaded$/
     */
    public function iRequestForAnyImageToBeDownloaded()
    {
        $context = $this;
        $downloadSdk = $this->getSDK()->Download();

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
     * @Then /^I receive an error$/
     */
    public function iGetAnError() {
        $response = null;

        $response = $this->downloadResponse;

        $this->assertTrue(is_a($response,'\Exception',true), "Expected Response Object to be an exception");
    }

    /**                                                                                                                                                                               
     * @Then /^the url has a (\w+) file type/                                                                                                                                              
     */                                                                                                                                                                               
    public function theUrlHasAFileType($fileType){
        $downloadResponse = json_decode($this->downloadResponse,true);
        $this->assertTrue(strpos($downloadResponse["uri"], $fileType) === 0,"Download is not of correct type");                                                                                                                                                 
    } 

    

    /**
     * @Then /^the url for the image is returned$/
     *
     */
    public function theUrlfortheImageIsReturned() {
        $downloadResponse = json_decode($this->downloadResponse,true);

        $this->assertTrue(strpos($downloadResponse["uri"], "https://delivery.gettyimages.com/xa/".$this->imageIdToDownload) === 0,"Download Response was not pointing to correct location");
    }
}
