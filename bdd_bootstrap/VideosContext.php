<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

class VideosContext extends BaseContext {
    
	protected $videoDetailParameters = array();
    protected $videoDetailsFields = array();
    protected $videoDetailsResponse = null;

    /**
     * @Given a video id
     */
    public function aVideoId() {
        $this->videoDetailParameters['videoId'] = '158885355';
    }

    /**
     * @Given a non-existent video id
     */
    public function aNonExistentVideoId() {
        $this->videoDetailParameters['videoIds'] = array('bogus 1','bogus 2'); 
    }

    /**
     * @Given a list of video ids
     */
    public function aListOfVideoIds() {
        $this->videoDetailParameters['videoIds'] = array('158885355','158885355'); 
    }

    /**
     * @Given caption field is specified
     */
    public function captionFieldIsSpecified() {
        array_push($this->videoDetailsFields,'caption');
    }

    /**
     * @When the video metadata request is executed
     */
    public function theVideoMetadataRequestIsExecuted() {
        $sdk = $this->sharedContext->getSDK();
        if (array_key_exists('videoId', $this->videoDetailParameters))
        {    
            $videoId = $this->videoDetailParameters['videoId'];
            $sdk = $sdk->Videos()->withId($videoId);
        }
        if (array_key_exists('videoIds', $this->videoDetailParameters))
        {    
            $videoIds = $this->videoDetailParameters['videoIds'];
            $sdk = $sdk->Videos()->withIds($videoIds);
        }
        $videoFields = $this->videoDetailsFields;        
        foreach ($videoFields as $field) {
            $sdk = $sdk->withResponseField($field);
        }
        try {
            $this->videoDetailsResponse = $sdk->execute();
        } catch (Exception $ex) {
            $this->videoDetailsResponse = $ex;
        }

        $this->sharedContext->sharedContextInfo['response'] = $this->videoDetailsResponse;
    }

    /**
     * @Then the video metadata is returned
     */
    public function theVideoMetadataIsReturned() {
        $response = json_decode($this->videoDetailsResponse,true);
        $videoId = $response["id"];
        $expectedVideoId = $this->videoDetailParameters['videoId'];
        $this->assertTrue($videoId == $expectedVideoId, 'Expected ID was not in the response');
    }
    /**
     * @Then a list of video metadata is returned
     */
    public function aListOfVideoMetadataIsReturned() {
        $response = json_decode($this->videoDetailsResponse,true);
        $this->assertTrue(array_key_exists('videos', $response));
        $this->assertTrue( count($response['videos']) > 0, 'Expected list of IDs was not in the response' );
    }
    /**
     * @Then the caption field is returned
     */
    public function theCaptionFieldIsReturned() {
        $response = json_decode($this->videoDetailsResponse,true);
        $this->assertTrue(array_key_exists('caption', $response));
    }
    /**
     * @Then an exception is thrown
     */
    public function anExceptionIsThrown() {
        $response = json_decode($this->videoDetailsResponse,true);
        $this->assertTrue(array_key_exists('videos', $response));
        $this->assertTrue( count($response['videos']) == 0, 'Expected list of IDs was not in the response' );   
    }
    /**
     * @Then the exception explains that the video was not found
     */
    public function theExceptionExplainsThatTheVideoWasNotFound() {
        $response = json_decode($this->videoDetailsResponse,true);
        $this->assertTrue(array_key_exists('videos_not_found', $response));
        $this->assertTrue( count($response['videos_not_found']) > 0, 'Expected list of not found IDs was not in the response' );
    }
}
