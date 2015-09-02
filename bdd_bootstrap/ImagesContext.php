<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

class ImagesContext extends BaseContext {
    
	protected $imageDetailParameters = array();
	protected $imageDetailsResponse = null;
  
	/**
     * @Given /^I have an image id I want details on$/
     */
    function iHaveAnImageIdIWantDetailsOn()
    {
        $this->imageDetailParameters["imageId"] = "482383805";
    }

    /**                                                                                                                                                                               
     * @Given I have a list of image ids I want details on                                                                                                                            
     */                                                                                                                                                                               
    public function iHaveAListOfImageIdsIWantDetailsOn()                                                                                                                              
    {            
        $this->imageDetailParameters["imageIds"] = array("482383805","183559345");                                                                                                                                                
    } 

    /**                                                                                                                                                                               
     * @When I retrieve details for the image        
     * @When I retrieve image details                                                                                                                                                                                                                                                                                  
     */                                                                                                                                                                               
    function iRetrieveDetailsForTheImage()                                                                                                                                     
    {
        $sdk = $this->sharedContext->getSDK();

        $imageId = $this->imageDetailParameters["imageId"];
        $imageFields = $this->sharedContext->requestFields;

		$sdk = $sdk->Images()->withId($imageId);

        for($i = 0; $i < count($imageFields); ++$i) {
            $sdk = $sdk->withResponseField($imageFields[$i]);
        }
        try {
            $this->imageDetailsResponse = $sdk->execute();
        } catch (Exception $ex) {
            $this->imageDetailsResponse = $ex;
        }
    }

    /**                                                                                                                                                                               
     * @When I retrieve details for the images                                                                                                                                        
     */                                                                                                                                                                               
    public function iRetrieveDetailsForTheImages()                                                                                                                                    
    { 
        $sdk = $this->sharedContext->getSDK();
        
        $imageIds = $this->imageDetailParameters["imageIds"];
        $requestFields = $this->sharedContext->requestFields;
        
        $sdk = $sdk->Images()->withIds($imageIds);

        for($i = 0; $i < count($requestFields); ++$i) {
            $sdk = $sdk->withResponseField($requestFields[$i]);
        }

        $response = $sdk->execute();
        
        $this->imageDetailsResponse = $response;
    }

    /**
     * @Then /^I get a response back that has my image details$/
     */
    public function iGetJsonBackThatHasMyImageDetails() {
        $response = json_decode($this->imageDetailsResponse,true);
        $expectedImageId = $this->imageDetailParameters["imageId"];

        $this->assertTrue(count($response["images"] > 0));
        $this->assertTrue($response["images"][0]["id"] == $expectedImageId, "Expected ID was not in the response");
    }

    /**
     * @Then /^the response contains (\w+)$/
     */
    public function theResponseContainsField($fieldName)
    {
        $response = json_decode($this->imageDetailsResponse,true);
        $images = $response["images"];
        $this->assertTrue(array_key_exists($fieldName,$images[0]));
    }

    /**
     * @Then /^I get a response back that has details for multiple images$/
     */
    public function iGetAResponseBackThatHasDetailsForMultipleImages() {
        $response = json_decode($this->imageDetailsResponse,true);

        $expectedImageId = $this->imageDetailParameters["imageIds"][0];

        $this->assertTrue(count($response["images"] > 1));

        $images = $response["images"];

        $foundImage = false;
        foreach($images as $image){
            if ($image["id"] == $expectedImageId){ 
                $foundImage = true;
            }
        }
        $this->assertTrue($foundImage, "Expected ID was not in the response");
    }

}
