<?php
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

include __DIR__."/../src/ConnectSDK.php";

use GettyImages\Connect\ConnectSDK;
use GettyImages\Connect\Request\Search\Filters\EditorialSegment\EditorialSegmentFilter;
use GettyImages\Connect\Request\Search\Filters\GraphicalStyle\GraphicalStyleFilter;

/**
 * Features context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
  public $authenticationTokenResponse = null;
  public $deferredSearch  = null;
  public $searchResponse = null;
  public $collectionsResponse = null;
  public $countriesResponse = null;
  public $searchParameters = array();
  public $imageDetailsResponse = null;
  public $imageDetailParameters = array();
  public $imageIdToDownload = "165375606";
  public $downloadResponse = null;
  public $sdk = null;
  public $apiKey = null;
  public $apiSecret = null;
  public $username = null;
  public $password = null;
  public $sandboxApiSecret = null;

  public $useSandboxCredentials = false;
  public $environment;

  /**
   * Initializes context.
   * Every scenario gets it's own context object.
   *
   * @param array $parameters context parameters (set them up through behat.yml)
   */
  public function __construct()
  {
    $environment = getenv("ConnectSDK_test_Environment");
    If(!$environment) {
      $environment = "production";
    }

    $this->environment = $environment;
  }

  public function getConnectBaseURI() {
    if($this->environment == "production") {
      return "https://connect.gettyimages.com/v3";
    }
  }

  public function getAuthURI() {
    if($this->environment == "production") {
      return "https://connect.gettyimages.com/oauth2/token";
    }
  }

    /**
     * @Given /^I am trying out connect$/
     */

    public function givenIamTryingOutConnect()
    {
        $this->useSandboxCredentials = true;
    }
    /**
     * @Given /^I have an apikey$/
     */
    public function givenIHaveAnAPIKey()
    {
        $envToGetkeyFrom = "ConnectSDK_test_ResourceOwner_clientkey";
        
        if($this->useSandboxCredentials) {
            $envToGetkeyFrom = "ConnectSDK_test_SandboxApiKey";
        }
        
        if(!getenv($envToGetkeyFrom)) {
            throw new \Exception("Environment var: ".$envToGetkeyFrom." was not found in the environment");
        }
    }

    /**
     * @Given /^an apisecret$/
     */
    public function givenIHaveAnAPISecret()
    {
        if($this->useSandboxCredentials) {
            $this->apiSecret = getenv("ConnectSDK_test_SandboxApiSecret");
        } else {
            $this->apiSecret = getenv("ConnectSDK_test_ResourceOwner_clientsecret");
        }
    }

    /**
     * @Given /^a username$/
     */
    public function givenAUsername()
    {
        if($this->useSandboxCredentials) {
            throw new \Exception("Currently configured for sandbox credentials, should not be sending in a username");
        } else {
            $this->username = getenv("ConnectSDK_test_ResourceOwner_username");
        }
    }

    /**
     * @Given /^a password$/
     */
    public function givenAPassword()
    {
        if($this->useSandboxCredentials) {
            throw new \Exception("Currently configured for sandbox credentials, should not be sending in a password");
        } else {
            $this->password = getenv("ConnectSDK_test_ResourceOwner_password");
        }
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
     * @Given /^I specify that I only want to return title with my search results$/
     */
    public function iSpecifyThatIOnlyWantToReturnTitleWithMySearchResults()
    {
        $this->deferredSearch = $this->deferredSearch->withResponseField("title");
    }


    /**
     * @Given /^I specify that I only want to return asset_family with my search results$/
     */
    public function iSpecifyOnlyToReturnAssetFamily()
    {
        $this->deferredSearch = $this->deferredSearch->withResponseField("asset_family");
    }

    /**
     * @Given /^I have an image id I want details on$/
     */
    public function iHaveAnImageIdIWantDetailsOn()
    {
        $this->imageDetailParameters["imageId"] = 1234567;
    }

    /**
     * @Given /^I specify I want to exclude images containing nudity$/
     */
    public function iHaveRequestedToExcludeNudity()
    {
        $this->deferredSearch = $this->deferredSearch->withExcludeNudity();
    }

    /**
     * @Then /^a token is returned$/
     */
    public function aTokenIsReturned() {
        $tokenResponse = $this->authenticationTokenResponse;

        $this->assertTrue($tokenResponse != null);

        $this->assertTrue(array_key_exists("access_token", $tokenResponse), "access_token was not present in the response");
        $this->assertTrue(array_key_exists("token_type", $tokenResponse), "token_type  was not present in the response");
        $this->assertTrue(array_key_exists("expires_in", $tokenResponse), "expires_in  was not present in the response");

        $this->assertTrue($tokenResponse["token_type"] == "Bearer", "expected Bearer token_type");
        $this->assertTrue($tokenResponse["expires_in"] == "1800");
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

    /**
     * @Then /^I get a successful response with no collections$/
     */
    public function iGetASuccessfulResponseWithNoCollections() {
        $response = json_decode($this->collectionsResponse);

        $this->assertTrue($response !== null);
        $this->assertTrue(count($response->collections) == 0);
    }

    /**
     * @Then /^I get a successful response with at least (\d+) collection$/
     */
    public function iGetASuccessfulResponseWithAtLeastCollection($minimumCount) {
        $response = json_decode($this->collectionsResponse);

        $this->assertTrue($response !== null);
        $this->assertTrue(count($response->collections) >= $minimumCount);
    }

    /**
     * @Then /^I get a list of countries$/
     */
    public function iGetAListOfCountries() {
        $response = json_decode($this->countriesResponse);

        $this->assertTrue($response !== null);
        $this->assertTrue(count($response->countries) > 1);
    }

    private function assertTrue($bool, $message = NULL) {
        if(!$bool) {
            $errorMessage = "Error: Expected True but was False\n";

            if($message) {
                $errorMessage = $errorMessage . "Message: " . $message;
            }

            throw new \Exception($errorMessage);
        }
    }

    private function assertAreEqual($left, $right, $message = NULL) {
        if($left !== $right) {
            $errorMessage = "Expected: " . $right . "\nWas: " . $left . "\n" . $message;
            throw new \Exception($errorMessage);
        }

        return true;
    }

    /**
     * @Then /^the url for the sandbox image is returned$/
     */
    public function theUrlForTheSandboxImageIsReturned() {
        $expectedResponseURL = $this->getConnectBaseURI() . "/sandboxdownloads/getty_images_large.jpg";
        $downloadResponse = $this->downloadResponse;

        $this->assertAreEqual($downloadResponse,
            $expectedResponseURL,
            "Download Response was not pointing to correct location");
    }

    /**
     * @Then /^the url for the image is returned$/
     *
     */
    public function theUrlfortheImageIsReturned() {
        $downloadResponse = $this->downloadResponse;
        $this->assertTrue(strpos($downloadResponse, "https://delivery.gettyimages.com/xa/".$this->imageIdToDownload) === 0,"Download Response was not pointing to correct location");
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
     * @Then /^I receive an error$/
     */
    public function iGetAnError() {
        $response = null;

        if(!is_null($this->imageDetailsResponse)) {
            $response = $this->imageDetailsResponse;
        } elseif (!is_null($this->downloadResponse)) {
            $response = $this->downloadResponse;
        }


        $this->assertTrue(is_a($response,'\Exception',true), "Expected Response Object to be an exception");
    }


    /**
     * @When /^I ask the sdk for an authentication token$/
     */
    public function iAskTheSdkForAnAuthenticationToken()
    {
        $sdk = $this->getSDK();

        $response = $sdk->getAccessToken();

        $this->authenticationTokenResponse = $response;

    }

    /**
     * @When /^I request for any image to be downloaded$/
     */
    public function iRequestForAnyImageToBeDownloaded()
    {
        $context = $this;
        $sdk = $this->getSDK();

        try {
            $response = $sdk->Download()
                ->withId($context->imageIdToDownload)
                ->execute();

            $context->downloadResponse = $response;

        } catch (\Exception $e) {
            $context->downloadResponse = $e;
        }


    }

    /**
     * @When /^I specify I want only embeddable images$/
     */
    public function iSpecifyIWantOnlyEmbeddableImages() {
        $search = $this->deferredSearch;

        $this->deferredSearch = $search->withEmbeddableImagesOnly();
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
     * @When /^I retrieve the results$/
     */
    public function iRetrieveTheResults()
    {
        $response = $this->deferredSearch->execute();
        $this->searchResponse = $response;
    }

    /**
     * @When /^I retrieve image details$/
     */
    public function iRetrieveImageDetails()
    {
        $sdk = $this->getSDK();

        $imageId = $this->imageDetailParameters['imageId'];
        $response = $sdk->Images()
                        ->withId($imageId)
                        ->execute();

        $this->imageDetailsResponse = $response;
    }


    /**
     * @When I retrieve page :arg1
     */
    public function iRetrievePage($arg1)
    {
        $search = $this->deferredSearch->withPage($arg1);
    }

    /**
     * @When /^I configure my search for creative images$/
     */
    public function iConfigureMySearchForCreativeImages()
    {
        $sdk = $this->getSDK();

        $searchObject = $sdk->Search()
                            ->Images()
                            ->Creative();

        $this->deferredSearch = $searchObject;
    }

    /**
     * @When /^I configure my search for editorial images$/
     */
    public function iConfigureMySearchForEditorialImages()
    {
        $searchObject = $this->getSDK()
                             ->Search()
                             ->Images()
                             ->Editorial();

        $this->deferredSearch = $searchObject;
    }

    /**
     * @When /^I configure my search for blended images$/
     */
    public function iConfigureMySearchForBlendedImages()
    {
        $searchObject = $this->getSDK()
                             ->Search()
                             ->Images();

        $this->deferredSearch = $searchObject;
    }

    /**
     * @When /^I specify an orientation (\w+)$/
     */
    public function iSpecifyAnOrientation($orientation)
    {
        $orientation = self::parseStringToStaticType(
                        '\GettyImages\Connect\Request\Search\Filters\Orientation\OrientationFilter',
                        $orientation);

        $searchObj = $this->deferredSearch
                          ->withOrientation($orientation);

        $this->deferredSearch = $searchObj;
    }

    /**
     * @When /^I specify a license model (\w+)$/
     */
    public function iSpecifyALicenseModel($licenseModel)
    {
        $licenseModelToGet = self::parseStringToStaticType(
                                '\GettyImages\Connect\Request\Search\Filters\LicenseModel\LicenseModelFilter',
                                $licenseModel);

        $searchObj = $this->deferredSearch
                          ->withLicenseModel($licenseModelToGet);

        $this->deferredSearch = $searchObj;
    }

    private static function parseStringToStaticType($className,$value) {
        $reflector = new ReflectionClass($className);
        if($reflector->hasMethod($value)) {
            $method = $reflector->getMethod($value);
            if($method->isStatic()) {
                $staticResult = $method->invoke(null);

                return $staticResult;
            }
        }

        return false;
    }

    /**
     * @When /^I specify (\w+) editorial segment$/
     */
    public function iSpecifyEntertainmentEditorialSegment($editorialSegment)
    {
        $edSeg = self::parseStringToStaticType(
                        '\GettyImages\Connect\Request\Search\Filters\EditorialSegment\EditorialSegmentFilter',
                        $editorialSegment);

        $search = $this->deferredSearch->withEditorialSegment($edSeg);
        $this->deferredSearch = $search;
    }

    /**
     * @When /^I specify a graphical (\w+)$/
     */
    public function iSpecifyaGraphicalStyle($graphicalStyle) {

        $edSeg = self::parseStringToStaticType(
                        '\GettyImages\Connect\Request\Search\Filters\GraphicalStyle\GraphicalStyleFilter',
                        $graphicalStyle);

        $searchObject = $this->deferredSearch->withGraphicalStyle($edSeg);

        $this->deferredSearch = $searchObject;
    }

    /**
     * @return ConnectSDK|null
     */
    private function getSDK() {
        $context = $this;

        if(is_null($context->sdk)) {

            $context->sdk = new ConnectSDK($context->apiKey,$context->apiSecret,$context->username,$context->password);

            return $context->sdk;

        }

        return $context->sdk;
    }
}

class TestConfigurationException extends Exception {
}
