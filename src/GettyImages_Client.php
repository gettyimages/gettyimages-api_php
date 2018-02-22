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
    require_once("Request/Images/Images.php");
    require_once("Request/Videos/Videos.php");
    require_once("Request/Search/SearchImages.php");
    require_once("Request/Search/SearchImagesCreative.php");
    require_once("Request/Search/SearchImagesEditorial.php");

    use GettyImages\Api\Request\Search\SearchImages;
    use GettyImages\Api\Request\Search\SearchImagesCreative;
    use GettyImages\Api\Request\Search\SearchImagesEditorial;
    use GettyImages\Api\Request\Download\Download;
    use GettyImages\Api\Request\Events;
    use GettyImages\Api\Request\Images\Images;
    use GettyImages\Api\Request\Videos\Videos;
    use GettyImages\Api\Request\Collections;
    use GettyImages\Api\Request\Countries;
    use GettyImages\Api\Crendentials;
    use GettyImages\Api\Curler\ICurler;

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

        private $container;

        /**
         * Constructor for ConnectSDK
         *
         * @param null $apiKey
         * @param null $apiSecret
         * @param null $username
         * @param null $password
         * @param null $refreshToken
         * @param null $container
         * @example UsageExamples.php Examples
         */
        private function __construct($apiKey, $apiSecret, $username = null, $password = null, $refreshToken = null, $container) {

            $credentials = array(
                "client_key" => $apiKey,
                "client_secret" => $apiSecret,
                "username" => $username,
                "password" => $password,
                "refresh_token" => $refreshToken);

            if($container == null)
            {
                $builder = new \DI\ContainerBuilder();
                $this->container = $builder->build();
                $this->container->set('ICurler', \DI\Object(Curler\Curler::Class));
            }
            else 
            {
                $this->container = $container;
            }

            $this->credentials = new Credentials($this->authEndpoint, $credentials, $this->container);
        }

        /**
         * Get client using client credentials
         *
         * @param null $apiKey
         * @param null $apiSecret
         * @param null $container
         */
        public static function getClientWithClientCredentials($apiKey, $apiSecret, $container = null)
        {
            return new GettyImages_Client($apiKey, $apiSecret, null, null, null, $container);
        }
        
        /**
         * Get client using resource owner credentials
         *
         * @param null $apiKey
         * @param null $apiSecret
         * @param null $username
         * @param null $password
         * @param null $container
         */
        public static function getClientWithResourceOwnerCredentials($apiKey, $apiSecret, $username, $password, $container = null)
        {
            return new GettyImages_Client($apiKey, $apiSecret, $username, $password, null, $container);
        }

        /**
         * Get client using refresh token
         *
         * @param null $apiKey
         * @param null $apiSecret
         * @param null $refreshToken
         * @param null $container
         */
        public static function getClientWithRefreshToken($apiKey, $apiSecret, $refreshToken, $container = null)
        {
            return new GettyImages_Client($apiKey, $apiSecret, null, null, $refreshToken, $container);
        }

        /**
         * Retrieves a authentication token for configured credentials
         */
        public function getAccessToken() {
            $authenticationResponse = $this->credentials->getAuthenticationDetails();
            return $authenticationResponse;
        }

        // /**
        //  *  Search
        //  *
        //  * @return Search A search request object initially configured with credentials
        //  */
        // public function Search() {
        //     $searchObj = new Search($this->credentials,$this->apiBaseUri,$this->container);

        //     return $searchObj;
        // }

        /**
         * Images
         *
         * Provides the start of the Images Request. Use this for getting details
         * for known image id's
         *
         * @return Images
         */
        public function Images() {
            $imagesObj = new Images($this->credentials,$this->apiBaseUri,$this->container);

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
            $videosObj = new Videos($this->credentials,$this->apiBaseUri,$this->container);

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
            $downloadObj = new Download($this->credentials,$this->apiBaseUri,$this->container);

            return $downloadObj;
        }

        /**
        * Events
        * 
        * Provides the start for the Events request. 
        */
        public function Events() {
            $eventsObj = new Events($this->credentials,$this->apiBaseUri,$this->container);
            return $eventsObj;
        }

        public function Collections() {
            $collectionsObj = new Collections($this->credentials,$this->apiBaseUri,$this->container);
            return $collectionsObj;
        }

        public function Countries() {
            $countriesObj = new Countries($this->credentials,$this->apiBaseUri,$this->container);
            return $countriesObj;
        }

        public function SearchImages() {
            $searchImagesObj = new SearchImages($this->credentials,$this->apiBaseUri,$this->container);
            return $searchImagesObj;
        }

        public function SearchImagesCreative() {
            $searchImagesCreativeObj = new SearchImagesCreative($this->credentials,$this->apiBaseUri,$this->container);
            return $searchImagesCreativeObj;
        }

        public function SearchImagesEditorial() {
            $searchImagesEditorialObj = new SearchImagesEditorial($this->credentials,$this->apiBaseUri,$this->container);
            return $searchImagesEditorialObj;
        }
    }
}
