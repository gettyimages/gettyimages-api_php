<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

class ImageSearchContext extends BaseContext {

    protected $deferredSearch = null;
    protected $searchResponse = null;

    /**
     * @Given /^I specify that I only want to return asset_family with my search results$/
     */
    public function iSpecifyOnlyToReturnAssetFamily()
    {
        $this->deferredSearch = $this->deferredSearch->withResponseField("asset_family");
    }

    /**
     * @Given /^I specify that I only want to return title with my search results$/
     */
    public function iSpecifyThatIOnlyWantToReturnTitleWithMySearchResults()
    {
        $this->deferredSearch = $this->deferredSearch->withResponseField("title");
    }

    /**
     * @Given /^I specify I want to exclude images containing nudity$/
     */
    public function iHaveRequestedToExcludeNudity()
    {
        $this->deferredSearch = $this->deferredSearch->withExcludeNudity();
    }

    /**
     * @Given /^I specify (\d+) number of items per page$/
     */
    public function iSpecifyNumberOfItemsPerPage($itemsPerPage)
    {
        $this->deferredSearch->withPageSize($itemsPerPage);
    }

    /**
     * @Given /^I want page (\d+)$/
     */
    public function iWantPage($pageNum)
    {
        $this->deferredSearch->withPage($pageNum);
    }

    /**
     * @When /^I retrieve the results$/
     */
    public function iRetrieveTheResults()
    {
        $response = $this->deferredSearch->execute();
        $this->searchResponse = $response;
    }

    /**
     * @When /^I configure my search for creative images$/
     */
    public function iConfigureMySearchForCreativeImages()
    {
        $sdk = $this->sharedContext->getSDK();

        $searchObject = $sdk->Search()
                            ->Images()
                            ->Creative();

        $this->deferredSearch = $searchObject;
    }

    /**
     * @When I search
     */
    public function iSearchWithoutPhrase()
    {
        $response = $this->deferredSearch->execute();

        $this->searchResponse = $response;
    }  

    /**
     * @When /^I search for ([\w ]+)$/
     */
    public function iSearchForPhrase($searchPhrase)
    {
        $response = $this->deferredSearch->withPhrase($searchPhrase)->execute();

        $this->searchResponse = $response;
    }

    /**
     * @When /^I configure my search for editorial images$/
     */
    public function iConfigureMySearchForEditorialImages()
    {
        $searchObject = $this->sharedContext->getSDK()
                             ->Search()
                             ->Images()
                             ->Editorial();

        $this->deferredSearch = $searchObject;
    }

    /**
     * @When /^I specify (\w+) editorial segment$/
     */
    public function iSpecifyEntertainmentEditorialSegment($editorialSegment)
    {
        $edSeg = self::parseStringToStaticType(
                        '\GettyImages\Api\Request\Search\Filters\EditorialSegmentFilter',
                        $editorialSegment);

        $search = $this->deferredSearch->withEditorialSegment($edSeg);
        $this->deferredSearch = $search;
    }

    /**
     * @When /^I specify a graphical (\w+)$/
     */
    public function iSpecifyaGraphicalStyle($graphicalStyle) {

        $edSeg = self::parseStringToStaticType(
                        '\GettyImages\Api\Request\Search\Filters\GraphicalStyleFilter',
                        $graphicalStyle);

        $searchObject = $this->deferredSearch->withGraphicalStyle($edSeg);

        $this->deferredSearch = $searchObject;
    }

    /**
     * @When /^I specify a license model (\w+)$/
     */
    public function iSpecifyALicenseModel($licenseModel)
    {
        $licenseModelToGet = self::parseStringToStaticType(
                                '\GettyImages\Api\Request\Search\Filters\LicenseModelFilter',
                                $licenseModel);

        $searchObj = $this->deferredSearch->withLicenseModel($licenseModelToGet);
        $this->deferredSearch = $searchObj;
    }

    /**
     * @When /^I configure my search for blended images$/
     */
    public function iConfigureMySearchForBlendedImages()
    {
        $searchObject = $this->sharedContext->getSDK()
                             ->Search()
                             ->Images();

        $this->deferredSearch = $searchObject;
    }

    /**                                                                                                                                                                                                  
     * @When I specify an artist                                                                                                                                                                         
     */                                                                                                                                                                                                  
    public function iSpecifyAnArtist()                                                                                                                                                                   
    {                                                                                                                                                                                                    
        $response = $this->deferredSearch->withArtists("roman makhmutov");
    }                                                                                                                                                                                                   
    
    /**                                       
     * @When /^I specify a (\w+-*\w+) age of people$/         
     */                                      
    public function iSpecifyAgeOfPeople($age)
    {
        $ageType = self::parseStringToStaticType(
                        '\GettyImages\Api\Request\Search\Filters\AgeOfPeopleFilter',
                        $age);
        
        $searchObject = $this->deferredSearch->withAgeOfPeople($ageType);
    }

    /**                                                                                                                                                                                                  
     * @When /^I specify a (\w+) collection code$/                                                                                                                                                             
     */                                                                                                                                                                                                  
    public function iSpecifyACollectionCode($collectionCode)                                                                                                                                                         
    {          
        $this->collectionCode = $collectionCode;                                                                                                                                                                  
    }    
    
    /**                                                                                                                                                                                                  
     * @When I specify a collection code                                                                                                                                                         
     */                                                                                                                                                                                                  
    public function iSpecifySomeCollectionCode()                                                                                                                                                         
    {          
        $this->collectionCode = "wri";
    }   

    /**
     * @When /^I specify an orientation (\w+)$/
     */
    public function iSpecifyAnOrientation($orientation)
    {
        $orientation = self::parseStringToStaticType(
                        '\GettyImages\Api\Request\Search\Filters\OrientationFilter',
                        $orientation);

        $searchObj = $this->deferredSearch->withOrientation($orientation);
        $this->deferredSearch = $searchObj;
    }

    /**                                                                                                                                                                                                  
     * @When I specify a include collection filter type                                                                                                                                                  
     */                                                                                                                                                                                                  
    public function iSpecifyAIncludeCollectionFilterType()                                                                                                                                               
    {                                                                                                                                                                                                    
        $response = $this->deferredSearch->withCollectionCode($this->collectionCode);
    }                                                                                                                                                                                                    
                                                                                                                                                                                                         
    /**                                                                                                                                                                                                  
     * @When I specify a exclude collection filter type                                                                                                                                                  
     */                                                                                                                                                                                                  
    public function iSpecifyAExcludeCollectionFilterType()                                                                                                                                               
    {                                                                                                                                                                                                    
        $response = $this->deferredSearch->withoutCollectionCode($this->collectionCode);
    }                                                                                                                                                                                                         
            
    /**                                                                                                                                                                                                                                    
     * @When /^I specify a location of (\w+)$/                                                                                                                                                                                            
     */                                                                                                                                                                                                                                    
    public function iSpecifyALocation($location)                                                                                                                                                                                        
    {                                
        $response = $this->deferredSearch->withSpecificLocations($location);
    }  

    /**                                                                                                                                                                                                                                                   
     * @When /^I specify a (\w+) composition$/
     */                                                                                                                                                                                                                                                   
    public function iSpecifyAStillLifeComposition($composition)                                                                                                                                                                                              
    {   
        $compositionType = self::parseStringToStaticType(
                        '\GettyImages\Api\Request\Search\Filters\CompositionFilter',
                        $composition);
        
        $response = $this->deferredSearch->withComposition($compositionType);
    }

    /**
     * @When /^I specify I want only embeddable images$/
     */
    public function iSpecifyIWantOnlyEmbeddableImages() {
        $search = $this->deferredSearch;

        $this->deferredSearch = $search->withEmbeddableImagesOnly();
    }

    /**                                                                                                                               
     * @When /^I specify (an|a) event id$/
     */                                                                                                                               
    public function iSearchForAnEventId($ignore)                                                                                                
    {    
        $response = $this->deferredSearch->withEventId(550100521);   
    }
              
    /**
     * @When I specify an end date
     */
    public function iSpecifyAnEndDate()
    {
        $response = $this->deferredSearch->withEndDate("2014-12-31");
    }

    /**
     * @When I specify an start date
     */
    public function iSpecifyAnStartDate()
    {
        $response = $this->deferredSearch->withStartDate("2014-01-01");
    }

    /**                                                                                                                                                                                                  
     * @When /^I specify an (\w+) ethnicity$/
     */                                                                                                                                                                                                  
    public function iSpecifyAnEthnicity($ethnicity)                                                                                                                                                                                                          
    {              
        $ethnicityType = self::parseStringToStaticType(
                        '\GettyImages\Api\Request\Search\Filters\EthnicityFilter',
                        $ethnicity);
        
        $response = $this->deferredSearch->withEthnicity($ethnicityType);
    }
    
    /**                                                                                                                                                                                                  
     * @When /^I specify a (\w+) file type$/                                                                                                                                                                   
     */                                                                                                                                                                                                  
    public function whenISpecifyAFileType($fileType)                                                                                                                                                               
    {       
        $fileTypeEnum = self::parseStringToStaticType(
                        '\GettyImages\Api\Request\Search\Filters\FileTypeFilter',
                        $fileType);
        
        $response = $this->deferredSearch->withFileType($fileTypeEnum);
    }                                                                                                                                                                                                          
    
    /**                                                                                                                                                                                                                                                   
     * @When I specify a keyword id
     */                                                                                                                                                                                                                                                   
    public function iSpecifyAKeywordId()                                                                                                                                                                                                    
    {                                                                                                                                                                                                                                                     
        $response = $this->deferredSearch->withKeywordId(62361);
    }

    /**                                                                                                                                                                                                                                    
     * @When /^I specify a (\w+) number of people in image$/
     */
    public function iSpecifyANumberOfPeopleInImage($number)                                                                                                                                                                                   
    {         
        //none,one,two,group
        $set = self::parseStringToStaticType(
                        '\GettyImages\Api\Request\Search\Filters\NumberOfPeopleFilter',
                        $number);

        $searchObject = $this->deferredSearch->withNumberOfPeople($set);
    }

    /**                                                                                                                               
     * @When /^I specify a (\w+) product type$/
     */                                                                                                    
    public function iSpecifyAProductType($productType)
    {                                                                                                                                 
        $response = $this->deferredSearch->withProductType($productType);
    }     
    
    /**                                                                                                                               
     * @When I specify I want only prestige images                                                                                    
     */                                                                                                                               
    public function iSpecifyIWantOnlyPrestigeImages()                                                                                 
    {                                                                         
        $response = $this->deferredSearch->withOnlyPrestigeContent();
    } 

     /**                                                                                                                               
     * @When I specify a specific person                                                                                              
     */                                                                                                                               
    public function iSpecifyASpecificPerson()                                                                                         
    {                                
        $response = $this->deferredSearch->withSpecificPeople("Reggie Jackson"); 
    }

    /**
     * @When I retrieve page :arg1
     */
    public function iRetrievePage($arg1)
    {
        $search = $this->deferredSearch->withPage($arg1);
    }

    /**
     * @Then /^I get a response back that has my images$/
     * @Then the response has images
     */
    public function iGetJsonBackThatHasMyKittens() {
        $searchResponse = json_decode($this->searchResponse,true);

        $this->assertTrue(array_key_exists("images", $searchResponse), "Expected response to have images key");
        $this->assertTrue(array_key_exists("result_count", $searchResponse), "Expected response to have a resultCount key");
        $this->assertTrue(count($searchResponse["images"]) > 0, "Expected images to have a count greater than 0");
        $this->assertTrue($searchResponse["result_count"] >= count($searchResponse["images"]) , "Expected images count to be less than or equal to resultCount");
    }

    /**
     * @Then /^only required return fields plus asset_family are returned$/
     */
    public function onlyRequiredReturnFieldsPlusSizesAreReturned() {
        $searchResponse = json_decode($this->searchResponse,true);

        $firstImage = $searchResponse["images"][0];

        $this->assertTrue(array_key_exists("id",$firstImage),"Expected id");
        $this->assertTrue(array_key_exists("asset_family",$firstImage),"Expected assetFamily");
    }

    /**
     * @Then /^only required return fields plus title are returned$/
     */
    public function onlyRequiredReturnFieldsPlusTitleareReturned() {
        $searchResponse = json_decode($this->searchResponse,true);

        $firstImage = $searchResponse["images"][0];

        $this->assertTrue(array_key_exists("id",$firstImage),"Expected id");
        $this->assertTrue(array_key_exists("title",$firstImage),"Expected title");
    }

    /**
     * @Then /^the number of items returned matches (\d+)$/
     */
    public function theNumberOfItemsReturnedMatches($expectedItemCount) {
        $searchResponse = json_decode($this->searchResponse,true);
        $this->assertTrue(count($searchResponse["images"]) == $expectedItemCount);
    }

    
}
