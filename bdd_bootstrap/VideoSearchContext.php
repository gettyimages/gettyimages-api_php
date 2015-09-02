<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

use GettyImages\Api\Request\Search\Filters\AgeOfPeopleFilter;
use GettyImages\Api\Request\Search\Filters\FormatFilter;
use GettyImages\Api\Request\Search\Filters\LicenseModelFilter;    

class VideoSearchContext extends BaseContext {

    protected $deferredSearch = null;
    protected $searchResponse = null;

    /**
     * @Given a blended video search
     */
    public function aBlendedVideoSearch() {
    	$searchObject = $this->sharedContext->getSDK()->Search()->Videos();
        $this->deferredSearch = $searchObject;
    }

    /**
     * @Given a creative video search
     */
    public function aCreativeVideoSearch() {
        $searchObject = $this->sharedContext->getSDK()->Search()->Videos()->Creative();
        $this->deferredSearch = $searchObject;
    }

    /**
     * @Given a editorial video search
     */
    public function aEditorialVideoSearch() {
        $searchObject = $this->sharedContext->getSDK()->Search()->Videos()->Editorial();
        $this->deferredSearch = $searchObject;
    }

    /**
     * @Given a search phrase
     */
    public function aSearchPhrase() {
        $this->deferredSearch = $this->deferredSearch->withPhrase('gorilla');
    }

    /**
     * @Given age of people filter is specified
     */
    public function ageOfPeopleFilterIsSpecified() {
        $searchObject = $this->deferredSearch->withAgeOfPeople(AgeOfPeopleFilter::Adults_Only());
    }

    /**
     * @Given largest_downloads field is specified
     */
    public function largestDownloadsFieldIsSpecified() {
        $this->deferredSearch = $this->deferredSearch->withResponseField('largest_downloads');
    }

    /**
     * @Given collection codes filter is specified
     */
    public function collectionCodesFilterIsSpecified() {
        $this->deferredSearch = $this->deferredSearch->withCollectionCode('BBR');
    }

    /**
     * @Given exclude nudity filter is specified
     */
    public function excludeNudityFilterIsSpecified() {
        $this->deferredSearch = $this->deferredSearch->withExcludeNudity();
    }

    /**
     * @Given format filter is specified
     */
    public function formatFilterIsSpecified() {
        $this->deferredSearch = $this->deferredSearch->withFormatFilter(FormatFilter::Hd());
    }

    /**
     * @Given product type filter is specified
     */
    public function productTypeFilterIsSpecified() {
        $this->deferredSearch = $this->deferredSearch->withProductType('easyaccess');
    }

    /**
     * @Given specific people filter is specified
     */
    public function specificPeopleFilterIsSpecified() {
        $this->deferredSearch = $this->deferredSearch->withSpecificPeople('Rihanna');
    }

    /**
     * @Given sort order is specified
     */
    public function sortOrderIsSpecified() {
        $this->deferredSearch = $this->deferredSearch->withSortOrder('most_popular');
    }

    /**
     * @Given page number is specified
     */
    public function pageNumberIsSpecified() {
        $this->deferredSearch = $this->deferredSearch->withPage(2);
    }

    /**
     * @Given page size is specified
     */
    public function pageSizeIsSpecified() {
        $this->deferredSearch = $this->deferredSearch->withPageSize(5);
    }

    /**
     * @Given license model filter is specified
     */
    public function licenseModelFilterIsSpecified() {
        $this->deferredSearch = $this->deferredSearch->withLicenseModel(LicenseModelFilter::RoyaltyFree());
    }

    /**
     * @When the video search is executed
     */
    public function theVideoSearchIsExecuted() {
        $response = $this->deferredSearch->execute();
        $this->searchResponse = $response;
        $this->sharedContext->sharedContextInfo['response'] = $response;
    }

    /**
     * @Then video search results are returned
     */
    public function videoSearchResultsAreReturned() {
        $response = json_decode($this->searchResponse,true);
        $this->assertTrue(array_key_exists('videos', $response));
        $this->assertTrue(count($response['videos']) > 0, 'Videos was empty' );
    }

    /**
     * @Then the largest_download field is returned
     */
    public function theLargestDownloadFieldIsReturned() {
        $response = json_decode($this->searchResponse,true);
        $this->assertTrue(array_key_exists('largest_downloads', $response['videos'][0]));
    }
}