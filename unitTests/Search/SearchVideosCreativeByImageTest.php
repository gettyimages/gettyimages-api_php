<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class SearchVideosCreativeByImageTest extends TestCase
{
    public function testSearchVideosCreativeByImageWithUrl()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreativeByImage()->withImageUrl("https://api.gettyimages.com/v3/search/by-image/uploads/my-test-image.jpg")->execute();
        $encodedUrl = urlencode("https://api.gettyimages.com/v3/search/by-image/uploads/my-test-image.jpg");
        $this->assertContains("search/videos/creative/by-image", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("image_url=".$encodedUrl, $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeByImageWithAssetId()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreativeByImage()->withAssetId("fakeasset")->execute();

        $this->assertContains("search/videos/creative/by-image", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("asset_id=fakeasset", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeByImageWithFields()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $fields = array("asset_family", "id", "uri_oembed");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreativeByImage()->withAssetId("fakeasset")->withFields($fields)->execute();

        $this->assertContains("search/videos/creative/by-image", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("asset_id=fakeasset", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("fields=asset_family%2Cid%2Curi_oembed", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeByImageWithPage()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreativeByImage()->withAssetId("fakeasset")->withPage(3)->execute();

        $this->assertContains("search/videos/creative/by-image", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("asset_id=fakeasset", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("page=3", $curlerMock->options[CURLOPT_URL]);
    }

    
    public function testSearchVideosCreativeByImageWithPageSize()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreativeByImage()->withAssetId("fakeasset")->withPageSize(50)->execute();

        $this->assertContains("search/videos/creative/by-image", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("asset_id=fakeasset", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("page_size=50", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeByImageWithProductTypes()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $types = array("easyaccess", "editorialsubscription");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreativeByImage()->withAssetId("fakeasset")->withProductTypes($types)->execute();

        $this->assertContains("search/videos/creative/by-image", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("asset_id=fakeasset", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("product_types=easyaccess%2Ceditorialsubscription", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeByImageWithAcceptLanguage()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreativeByImage()->withAcceptLanguage("en-US")->execute();

        $this->assertContains("search/videos/creative/by-image", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("Accept-Language: en-US", $curlerMock->options[CURLOPT_HTTPHEADER]);
    }
}