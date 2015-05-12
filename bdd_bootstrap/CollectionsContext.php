<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

class CollectionsContext extends BaseContext {
  
    protected $collectionsResponse = null;

    /**
     * @When I retrieve collections
     */
    public function iRetrieveCollections()
    {
        $sdk = $this->sharedContext->getSDK();

        try {
          $this->collectionsResponse = $sdk->Collections()->execute();
        } catch (Exception $ex) {
          $this->collectionsResponse = $ex;
        }
    }

    /**
     * @Then I recieve an error stating :arg1
     */
    public function iRecieveAnErrorStating($arg1)
    {
      if(is_a($this->collectionsResponse,"\Exception",true)) {

      } else {
        throw new \Exception("Response wasn't an exception");
      }
    }

    /**
     * @Then I receive collection details
     */
    public function iReceiveCollectionDetails()
    {
      $collectionsArray = JSON_DECODE($this->collectionsResponse,true);
      $this->assertTrue(count($collectionsArray["collections"]) > 0);
    }
}
