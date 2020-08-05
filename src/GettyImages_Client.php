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
    require_once("Request/Downloads/Downloads.php");
    require_once("Request/Downloads/DownloadImage.php");
    require_once("Request/Downloads/DownloadVideo.php");
    require_once("Request/Images/Images.php");
    require_once("Request/Images/ImagesSimilar.php");
    require_once("Request/Videos/Videos.php");
    require_once("Request/Videos/VideosSimilar.php");
    require_once("Request/Search/SearchImages.php");
    require_once("Request/Search/SearchImagesCreative.php");
    require_once("Request/Search/SearchImagesEditorial.php");
    require_once("Request/Search/SearchVideos.php");
    require_once("Request/Search/SearchVideosCreative.php");
    require_once("Request/Search/SearchVideosEditorial.php");
    require_once("Request/Search/SearchEvents.php");
    require_once("Request/CustomRequest/CustomRequest.php");

    use GettyImages\Api\Request\Search\SearchImages;
    use GettyImages\Api\Request\Search\SearchImagesCreative;
    use GettyImages\Api\Request\Search\SearchImagesEditorial;
    use GettyImages\Api\Request\Search\SearchVideos;
    use GettyImages\Api\Request\Search\SearchVideosCreative;
    use GettyImages\Api\Request\Search\SearchVideosEditorial;
    use GettyImages\Api\Request\Search\SearchEvents;
    use GettyImages\Api\Request\Downloads\Downloads;
    use GettyImages\Api\Request\Downloads\DownloadImage;
    use GettyImages\Api\Request\Downloads\DownloadVideo;
    use GettyImages\Api\Request\Events;
    use GettyImages\Api\Request\Images\Images;
    use GettyImages\Api\Request\Images\ImagesSimilar;
    use GettyImages\Api\Request\Videos\Videos;
    use GettyImages\Api\Request\Videos\VideosSimilar;
    use GettyImages\Api\Request\Collections;
    use GettyImages\Api\Request\Countries;
    use GettyImages\Api\Crendentials;
    use GettyImages\Api\Curler\ICurler;
    use GettyImages\Api\Request\CustomRequest\CustomRequest;

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
         * @param null $accessToken
         * @example UsageExamples.php Examples
         */
        private function __construct($apiKey, $apiSecret, $username = null, $password = null, $refreshToken = null, $container, $accessToken = null) {

            $credentials = array(
                "client_key" => $apiKey,
                "client_secret" => $apiSecret,
                "username" => $username,
                "password" => $password,
                "refresh_token" => $refreshToken,
                "access_token" => $accessToken);

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
         * Get client using access token and refresh token
         *
         * @param null $apiKey
         * @param null $apiSecret
         * @param null $accessToken
         * @param null $refreshToken
         * @param null $container
         */
        public static function getClientWithAccessToken($apiKey, $apiSecret, $accessToken, $refreshToken, $container = null)
        {
            return new GettyImages_Client($apiKey, $apiSecret, null, null, $refreshToken, $container, $accessToken);
        }

        /**
         * Retrieves a authentication token for configured credentials
         */
        public function getAccessToken() {
            $authenticationResponse = $this->credentials->getAuthenticationDetails();
            return $authenticationResponse;
        }

        /**
         * Images
         *
         * Get metadata for images
         *
         * @return Images
         */
        public function Images() {
            $imagesObj = new Images($this->credentials,$this->apiBaseUri,$this->container);

            return $imagesObj;
        }

        /**
         * ImagesSimilar
         *
         * Get similar images
         *
         * @return ImagesSimilar
         */
        public function ImagesSimilar() {
            $imagesSimilarObj = new ImagesSimilar($this->credentials,$this->apiBaseUri,$this->container);

            return $imagesSimilarObj;
        }

        /**
         * Videos
         *
         * Get metadata for videos
         *
         * @return Videos
         */
        public function Videos() {
            $videosObj = new Videos($this->credentials,$this->apiBaseUri,$this->container);

            return $videosObj;
        }

        /**
         * VideosSimilar
         *
         * Get similar videos
         *
         * @return VideosSimilar
         */
        public function VideosSimilar() {
            $videosSimilarObj = new VideosSimilar($this->credentials,$this->apiBaseUri,$this->container);

            return $videosSimilarObj;
        }

        /**
         * Download
         *
         * Returns information about a customer's downloaded assets
         *
         * @return Downloads
         */
        public function Downloads() {
            $downloadObj = new Downloads($this->credentials,$this->apiBaseUri,$this->container);

            return $downloadObj;
        }

        /**
         * DownloadImage
         *
         * Download an image
         *
         * @return DownloadImage
         */
        public function DownloadImage() {
            $downloadImageObj = new DownloadImage($this->credentials,$this->apiBaseUri,$this->container);

            return $downloadImageObj;
        }

        /**
         * DownloadVideo
         *
         * Download a video
         *
         * @return DownloadVideo
         */
        public function DownloadVideo() {
            $downloadVideoObj = new DownloadVideo($this->credentials,$this->apiBaseUri,$this->container);

            return $downloadVideoObj;
        }

        /**
        * Events
        *
        * Get metadata fro events
        */
        public function Events() {
            $eventsObj = new Events($this->credentials,$this->apiBaseUri,$this->container);
            return $eventsObj;
        }

        /**
         * Collections
         *
         * Get collections applicable for the customer
         *
         * @return Collections
         */
        public function Collections() {
            $collectionsObj = new Collections($this->credentials,$this->apiBaseUri,$this->container);
            return $collectionsObj;
        }

        /**
         * Countries
         *
         * Get country codes and names
         *
         * @return Countries
         */
        public function Countries() {
            $countriesObj = new Countries($this->credentials,$this->apiBaseUri,$this->container);
            return $countriesObj;
        }

        /**
         * SearchImages
         *
         * Search for both creative and editorial images
         *
         * @return SearchImages
         */
        public function SearchImages() {
            $searchImagesObj = new SearchImages($this->credentials,$this->apiBaseUri,$this->container);
            return $searchImagesObj;
        }

        /**
         * SearchImagesCreative
         *
         * Search for creative Images
         *
         * @return SearchImagesCreative
         */
        public function SearchImagesCreative() {
            $searchImagesCreativeObj = new SearchImagesCreative($this->credentials,$this->apiBaseUri,$this->container);
            return $searchImagesCreativeObj;
        }

        /**
         * SearchImagesEditorial
         *
         * Search for editorial images
         *
         * @return SearchImagesEditorial
         */
        public function SearchImagesEditorial() {
            $searchImagesEditorialObj = new SearchImagesEditorial($this->credentials,$this->apiBaseUri,$this->container);
            return $searchImagesEditorialObj;
        }

        /**
         * SearchVideos
         *
         * Search for both creative and editorial videos
         *
         * @return SearchVideos
         */
        public function SearchVideos() {
            $searchVideosObj = new SearchVideos($this->credentials,$this->apiBaseUri,$this->container);
            return $searchVideosObj;
        }

        /**
         * SearchVideosCreative
         *
         * Search for creative videos
         *
         * @return SearchVideosCreative
         */
        public function SearchVideosCreative() {
            $searchVideosCreativeObj = new SearchVideosCreative($this->credentials,$this->apiBaseUri,$this->container);
            return $searchVideosCreativeObj;
        }

        /**
         * SearchVideosEditorial
         *
         * Search for editorial videos
         *
         * @return SearchVideosEditorial
         */
        public function SearchVideosEditorial() {
            $searchVideosEditorialObj = new SearchVideosEditorial($this->credentials,$this->apiBaseUri,$this->container);
            return $searchVideosEditorialObj;
        }

        /**
         * SearchEvents
         *
         * Search for events
         *
         * @return SearchEvents
         */
        public function SearchEvents() {
            $searchEventsObj = new SearchEvents($this->credentials,$this->apiBaseUri,$this->container);
            return $searchEventsObj;
        }

        /**
         * CustomRequest
         *
         * Create a request that is not directly supported by this SDK
         *
         * @return CustomRequest
         */
        public function CustomRequest() {
            $customRequestObj = new CustomRequest($this->credentials,$this->apiBaseUri,$this->container);
            return $customRequestObj;
        }
    }
}
