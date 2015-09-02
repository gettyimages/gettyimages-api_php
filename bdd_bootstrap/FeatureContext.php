<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Behat\Context\SnippetAcceptingContext;

include __DIR__."/../build/GettyImagesApi.phar";

use GettyImages\Api\GettyImages_Client;

abstract class BaseContext implements Context, SnippetAcceptingContext {
    protected $sharedContext = null;

    /** @BeforeScenario */
    public function gatherContexts(BeforeScenarioScope $scope) {

        $environment = $scope->getEnvironment();
        $this->sharedContext = $environment->getContext('SharedContext');
    }

    public function assertTrue($bool, $message = NULL) {
        if(!$bool) {
            $errorMessage = "Error: Expected True but was False\n";

            if($message) {
                $errorMessage = $errorMessage . "Message: " . $message;
            }

            throw new \Exception($errorMessage);
        }
    }

    public static function parseStringToStaticType($className,$value) {
    
        $reflector = new ReflectionClass($className);
        $methodName = self::MapKnownIllegalValuesToLegalMethodName($value);        
        if ($reflector->hasMethod($methodName)) {
            $method = $reflector->getMethod($methodName);
            if ($method->isStatic()) {
                $staticResult = $method->invoke(null);

                return $staticResult;
            }
        }

        return false;
    }

    public static function MapKnownIllegalValuesToLegalMethodName($name)    
    {                
        $legalNameMap  = array(
            '0-1_months' => 'ZeroToOne_Months',
            '2-5_months' => 'TwoToFive_Months',
            '6-11_months' => 'SixToEleven_Months',
            '12-17_months' => 'TwelveToSeventeen_Months',
            '18-23_months' => 'EighteenToTwentyThree_Months',
            '2-3_years' => 'TwoToThree_Years',
            '4-5_years' => 'FourToFive_Years',
            '6-7_years' => 'SixToSeven_Years',
            '8-9_years' => 'EightToNine_Years',
            '10-11_years' => 'TenToEleven_Years',
            '12-13_years' => 'TwelveToThirteen_Years',
            '14-15_years' => 'FourteenToFifteen_Years',
            '16-17_years' => 'SixteenToSeventeen_Years',
            '18-19_years' => 'EighteenToNineteen_Years',
            '20-24_years' => 'TwentyToTwentyFour_Years',
            '20-29_years' => 'TwentyToTwentyNine_Years',
            '25-29_years' => 'TwentyFiveToTwentyNine_Years',
            '30-34_years' => 'ThirtyToThirtyFour_Years',
            '30-39_years' => 'ThirtyToThirtyNine_Years',
            '35-39_years' => 'ThirtyFiveToThirtyNine_Years',
            '40-44_years' => 'FortyToFortyFour_Years',
            '40-49_years' => 'FortyToFortyNine_Years',
            '45-49_years' => 'FortyFiveToFortyNine_Years',
            '50-54_years' => 'FiftyToFiftyFour_Years',
            '50-59_years' => 'FiftyToFiftyNine_Years',
            '55-59_years' => 'FiftyFiveToFiftyNine_Years',
            '60-64_years' => 'SixtyToSixtyFour_Years',
            '60-69_years' => 'SixtyToSixtyNine_Years',
            '65-69_years' => 'SixtyFiveToSixtyNine_Years',
            '70-79_years' => 'SeventyToSeventyNine_Years',
            '80-89_years' => 'EightyToEightyNine_Years',
            '90_plus_years' => 'NinetyPlus_Years',
            '100_over' => 'OneHundredAndOver_Years',
            'abstract' => 'Abstract_'
        );
        
        if (!array_key_exists($name, $legalNameMap)) return $name;
        
        return $legalNameMap[$name];
    } 
}

class FeatureContext extends BaseContext {

    protected $useSandboxCredentials = false;

    /**
     * @Given /^I specify field (\w+)$/
     */
    public function givenISpecifyField($fieldName)
    {
        array_push($this->sharedContext->requestFields,$fieldName);
    } 
    
    /**
     * @Given /^I have an apikey$/
     * @Given an api key
     */
    function givenIHaveAnAPIKey() {

        $envToGetkeyFrom = "GettyImagesApi_ApiKey";

        if($this->useSandboxCredentials) {
            $envToGetkeyFrom = "GettyImagesApi_SandboxApiKey";
        }

        $apiKey = $this->getEnvValueAndThrowIfNotSet($envToGetkeyFrom);

        $this->sharedContext->setApiKey($apiKey);
    }

    /**
     * @Given an apisecret
     * @Given an api secret
     */
    function anApisecret() {

        $envToGetkeyFrom = "GettyImagesApi_ApiSecret";

        if($this->useSandboxCredentials) {
            $envToGetkeyFrom = "GettyImagesApi_SandboxApiSecret";
        }

        $apiSecret = $this->getEnvValueAndThrowIfNotSet($envToGetkeyFrom);

        $this->sharedContext->setApiSecret($apiSecret);
    }

    /**
     * @Given /^a username$/
     * @Given a user name
     */
    public function givenAUsername()
    {
        $envToGetKeyFrom = "GettyImagesApi_UserName";

        if($this->useSandboxCredentials) {
            throw new \Exception("Currently configured for sandbox credentials, should not be sending in a username");
        }

        $username = $this->getEnvValueAndThrowIfNotSet($envToGetKeyFrom);

        $this->sharedContext->setUsername($username);
    }

    /**
     * @Given /^a password$/
     * @Given a user password
     */
    public function givenAPassword()
    {
        $envToGetKeyFrom = "GettyImagesApi_UserPassword";

        if($this->useSandboxCredentials) {
            throw new \Exception("Currently configured for sandbox credentials, should not be sending in a password");
        }

        $password = $this->getEnvValueAndThrowIfNotSet($envToGetKeyFrom);

        $this->sharedContext->setPassword($password);
    }

    /**
     * @Then the status is success
     */
    public function theStatusIsSuccess()
    {
        $response = json_decode($this->sharedContext->sharedContextInfo['response'],true);
        
    }

    private function getEnvValueAndThrowIfNotSet($envKey) {
        if(!getenv($envKey)) {
            throw new \Exception("Environment var: ".$envKey." was not found in the environment");
        }

        return getenv($envKey);
    }
}
