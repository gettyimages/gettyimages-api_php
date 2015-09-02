<?php
/**
 * GettyImages API SDK by Getty Images.
 * Provides an interface to Getty Images connect api.
 *
 * The goal of the SDK is to simplify credential management and provide a reusable library
 * for developers.
 *
 * @link https://php.net//manual/en/book.curl.php
 * @link https://php.net/manual/en/function.curl-errno.php
 * @link http://en.wikipedia.org/wiki/PHPDoc
 *
 */

namespace GettyImages\Api {
    require_once("Request/FluentRequest.php");
    require_once("Credentials.php");
    require_once("Request/Collections.php");
    require_once("Request/Countries.php");
    require_once("Request/Events.php");
    require_once("Request/WebHelper.php");
    require_once("Request/Download/Download.php");
    require_once("Request/Images.php");
    require_once("Request/Videos.php");
    require_once("Request/Search/Search.php");

    use GettyImages\Api\Request\Search\Search;
    use GettyImages\Api\Request\Download\Download;
    use GettyImages\Api\Request\Events;
    use GettyImages\Api\Request\Images;
    use GettyImages\Api\Request\Videos;
    use GettyImages\Api\Request\Collections;
    use GettyImages\Api\Request\Countries;
    use GettyImages\Api\Crendentials;

    /**
     * GettyImages API SDK - GettyImages_Client
     *
     * Provides a code api for interacting with Getty Images REST services @ http://api.gettyimages.com.
     */
    class GettyImages_Client {

        /** @ignore */
        private $credentials = null;

        /** @ignore */
        private $apiBaseUri = "https://api.gettyimages.com/v3";

        private $authEndpoint = "https://api.gettyimages.com/oauth2/token";

        /**
         * Constructor for ConnectSDK
         *
         * @param null $apiKey
         * @param null $apiSecret
         * @param null $username
         * @param null $password
         * @example UsageExamples.php Examples
         */
        public function __construct($apiKey, $apiSecret = null, $username = null, $password = null, $refreshToken = null) {

            $credentials = array(
                "client_key" => $apiKey,
                "client_secret" => $apiSecret,
                "username" => $username,
                "password" => $password,
                "refresh_token" => $refreshToken);

            $this->credentials = new Credentials($this->authEndpoint ,$credentials);
        }

        /**
         * Retrieves a authentication token for configured credentials
         */
        public function getAccessToken() {
            $authenticationResponse = $this->credentials->getAuthenticationDetails();
            return $authenticationResponse;
        }

        /**
         *  Search
         *
         * @return Search A search request object initially configured with credentials
         */
        public function Search() {
            $searchObj = new Search($this->credentials,$this->apiBaseUri);

            return $searchObj;
        }

        /**
         * Images
         *
         * Provides the start of the Images Request. Use this for getting details
         * for known image id's
         *
         * @return Images
         */
        public function Images() {
            $imagesObj = new Images($this->credentials,$this->apiBaseUri);

            return $imagesObj;
        }

        /**
         * Images
         *
         * Provides the start of the Videos Request. Use this for getting details
         * for known video id's
         *
         * @return Videos
         */
        public function Videos() {
            $videosObj = new Videos($this->credentials,$this->apiBaseUri);

            return $videosObj;
        }

        /**
         * Download
         *
         * Provides the start of the Download request. Use this for downloading
         * for a known image Id
         *
         * @return Download
         */
        public function Download() {
            $downloadObj = new Download($this->credentials,$this->apiBaseUri);

            return $downloadObj;
        }

        /**
        * Events
        * 
        * Provides the start for the Events request. 
        */
        public function Events() {
            $eventsObj = new Events($this->credentials,$this->apiBaseUri);
            return $eventsObj;
        }

        public function Collections() {
            $collectionsObj = new Collections($this->credentials,$this->apiBaseUri);
            return $collectionsObj;
        }

        public function Countries() {
            $countriesObj = new Countries($this->credentials,$this->apiBaseUri);
            return $countriesObj;
        }


    }
}
