<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

class CountriesContext extends SharedCredentials implements Context, SnippetAcceptingContext
{
	protected $countriesResponse = null;

	/**
     * @When I retrieve countries
     */
    public function iRetrieveCountries()
    {
        $sdk = $this->getSDK();
        
        try {
            $this->countriesResponse = $sdk->Countries()->execute();
        } catch (Exception $ex) {
            $this->countriesResponse = $ex;
        }
    }

    /**
     * @Then I get a response back that has a list of countries
     */
    public function iGetAResponseBackThatHasAListOfCountries()
    {
      	$countriesResponse = json_decode($this->countriesResponse,true);
      	$this->assertTrue(count($countriesResponse["countries"]) > 0, "Expected countries to have a count greater than 0");
    } 
    
}
