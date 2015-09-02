<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

class EventsContext extends BaseContext {
    
	protected $eventDetailParameters = array();
	protected $eventDetailsFields = array();
	protected $eventDetailsResponse = null;
  
	/**
     * @Given I have an event id I want details on
     */
    public function iHaveAnEventIdIWantDetailsOn()
    {
        $this->eventDetailsParameters["eventId"] = "1";
    }

    /**                                                                                                                                                                               
     * @Given I have a list of event ids I want details on                                                                                                                            
     */                                                                                                                                                                               
    public function iHaveAListOfEventIdsIWantDetailsOn()                                                                                                                              
    {            
        $this->eventDetailsParameters["eventIds"] = array("1","2");                                                                                                                                                
    }

    /**                                                                                                                                                                               
     * @When I retrieve details for the event        
     * @When I retrieve event details                                                                                                                                                                                                                                                                                  
     */                                                                                                                                                                               
    public function iRetrieveDetailsForTheEvent()                                                                                                                                     
    {
        $sdk = $this->sharedContext->getSDK();

        $eventId = $this->eventDetailsParameters["eventId"];
        $eventFields = $this->sharedContext->requestFields;

		$sdk = $sdk->Events()->withId($eventId);

        for($i = 0; $i < count($eventFields); ++$i) {
            $sdk = $sdk->withResponseField($eventFields[$i]);
        }
        try {
            $this->eventDetailsResponse = $sdk->execute();
        } catch (Exception $ex) {
            $this->eventDetailsResponse = $ex;
        }
    }

    /**                                                                                                                                                                               
     * @When I retrieve details for the events                                                                                                                                        
     */                                                                                                                                                                               
    public function iRetrieveDetailsForTheEvents()                                                                                                                                    
    { 
        $sdk = $this->sharedContext->getSDK();
        
        $eventIds = $this->eventDetailsParameters["eventIds"];
        $eventFields = $this->sharedContext->requestFields;
        
        $sdk = $sdk->events()->withIds($eventIds);

        for($i = 0; $i < count($eventFields); ++$i) {
            $sdk = $sdk->withResponseField($eventFields[$i]);
        }

        $response = $sdk->execute();
        
        $this->eventDetailsResponse = $response;
    }

    /**
     * @Then /^I get a response back that has my event$/
     */
    public function iGetAResponseBackThatHasMyEvent() {
        $response = json_decode($this->eventDetailsResponse,true);
        $expectedEventId = $this->eventDetailsParameters["eventId"];

        $this->assertTrue(array_key_exists("id",$response));
        $this->assertTrue($response["id"] == $expectedEventId);
    }

    /**
     * @Then /^the response contains (\w+)$/
     */
    public function theResponseContains($fieldName)
    {
        $response = json_decode($this->eventDetailsResponse,true);

        $this->assertTrue(array_key_exists($fieldName,$response), $this->eventDetailsResponse);
    }

    /**
     * @Then /^I get a response back that has details for multiple events$/
     */
    public function iGetAResponseBackThatHasDetailsForMultipleevents() {
        $response = json_decode($this->eventDetailsResponse,true);

        $expectedEventId = (int)$this->eventDetailsParameters["eventIds"][0];

        $this->assertTrue(count($response["events"] > 1));

        $events = $response["events"];

        $foundEvent = false;
        foreach($events as $event){
            if ($event["id"] == $expectedEventId) { 
                $foundEvent = true;
            }
        }
        $this->assertTrue($foundEvent, "Expected ID was not in the response");
    }

}
