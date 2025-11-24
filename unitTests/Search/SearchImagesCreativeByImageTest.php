<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class SearchImagesCreativeByImageTest extends TestCase
{
    public function testSearchImagesCreativeByImageWithUrl()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreativeByImage()->withImageUrl("https://api.gettyimages.com/v3/search/by-image/uploads/my-test-image.jpg")->execute();
        $encodedUrl = urlencode("https://api.gettyimages.com/v3/search/by-image/uploads/my-test-image.jpg");
        $this->assertStringContainsString("search/images/creative/by-image", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("image_url=".$encodedUrl, $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeByImageWithAssetId()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreativeByImage()->withAssetId("fakeasset")->execute();

        $this->assertStringContainsString("search/images/creative/by-image", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("asset_id=fakeasset", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeByImageWithFields()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $fields = array("asset_family", "id", "uri_oembed");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreativeByImage()->withAssetId("fakeasset")->withFields($fields)->execute();

        $this->assertStringContainsString("search/images/creative/by-image", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("asset_id=fakeasset", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("fields=asset_family%2Cid%2Curi_oembed", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeByImageWithPage()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreativeByImage()->withAssetId("fakeasset")->withPage(3)->execute();

        $this->assertStringContainsString("search/images/creative/by-image", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("asset_id=fakeasset", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("page=3", $curlerMock->options[CURLOPT_URL]);
    }

    
    public function testSearchImagesCreativeByImageWithPageSize()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreativeByImage()->withAssetId("fakeasset")->withPageSize(50)->execute();

        $this->assertStringContainsString("search/images/creative/by-image", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("asset_id=fakeasset", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("page_size=50", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeByImageWithProductTypes()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $types = array("easyaccess", "editorialsubscription");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreativeByImage()->withAssetId("fakeasset")->withProductTypes($types)->execute();

        $this->assertStringContainsString("search/images/creative/by-image", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("asset_id=fakeasset", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("product_types=easyaccess%2Ceditorialsubscription", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeByImageWithAcceptLanguage()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreativeByImage()->withAcceptLanguage("en-US")->execute();

        $this->assertStringContainsString("search/images/creative/by-image", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("Accept-Language: en-US", $curlerMock->options[CURLOPT_HTTPHEADER]);
    }
}