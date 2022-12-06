<?php

namespace GettyImages\Api\Request\Search {

use GettyImages\Api\Request\FluentRequest;
use GettyImages\Api\Request\WebHelper;
use Exception;

class SearchVideosCreativeByImage extends FluentRequest {

    /**
     * @ignore
     */
    protected $route = "search/videos/creative/by-image";

    protected function getRoute() {
        return $this->route;
    }

    protected function getMethod() {
        return "get";
    }

    /**
    * @ignore
     */
    private function addToBucket(string $destFilename, string $sourceFilepath)
    {
        $route = 'search/by-image/uploads/'.$destFilename;
        $fileUrl = $this->endpointUri."/".$route;
        self::executeFileUpload($route, $sourceFilepath);
        return $fileUrl;
    }

    public function addToBucketAndSearchAsync(string $filename, string $imageFilepath)
    {
        $url = self::addToBucket($filename, $imageFilepath);
        return self::withImageUrl($url);
    }

    /**
     * @param int $pageNum
     * @return $this
     */
    public function withImageUrl(string $url) {
        $this->requestDetails["image_url"] = $url;
        return $this;
    }

    /**
     * @param int $pageNum
     * @return $this
     */
    public function withAssetId(string $assetId) {
        $this->requestDetails["asset_id"] = $assetId;
        return $this;
    }

    /**
     * Will set the search request to only return the fields provided.
     *
     * @param array $fields An array of field names to include in the response.
     * this list isn't exclusive, default fields are always returned.
     * @throws Exception
     * @return $this
     */
    public function withFields(array $fields) {
        $this->addArrayOfValuesToRequestDetails("fields", $fields);
        return $this;
    }

    /**
     * @param int $pageNum
     * @return $this
     */
    public function withPage(int $pageNum) {
        $this->requestDetails["page"] = $pageNum;
        return $this;
    }

    /**
     * @param int $pageSize
     * @return $this
     */
    public function withPageSize(int $pageSize) {
        $this->requestDetails["page_size"] = $pageSize;
        return $this;
    }

    /**
     * @param array $productTypes An array of product types by which to filter.
     * @throws Exception
     * @return $this
     */
    public function withProductTypes(array $productTypes) {
        $this->addArrayOfValuesToRequestDetails("product_types", $productTypes);
        return $this;
    }

    /**
     * @param array $acceptLanguage Provide a header to specify the language of result values.
     * @throws Exception
     * @return $this
     */
    public function withAcceptLanguage(string $acceptLanguage) {
        $this->addHeader("Accept-Language", $acceptLanguage);
        return $this;
    }
}
}