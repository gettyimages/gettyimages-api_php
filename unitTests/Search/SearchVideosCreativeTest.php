<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class SearchVideosCreativeTest extends TestCase
{
    public function testSearchVideosCreativeWithPhrase()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->execute();

        $this->assertStringContainsString("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeWithAgeOfPeople()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $people = array("newborn","2-3_years","0-1_months");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withAgeOfPeople($people)->withPhrase("cat")->execute();

        $this->assertStringContainsString("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("age_of_people=newborn%2C2-3_years%2C0-1_months", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeWithCollectionCodes()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $codes = array("WRI", "ARF");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withCollectionCodes($codes)->execute();

        $this->assertStringContainsString("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("collection_codes=wri%2Carf", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeWithCollectionFilterType()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withCollectionFilterType("exclude")->execute();

        $this->assertStringContainsString("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("collections_filter_type=exclude", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeWithExcludeNudity()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withExcludeNudity()->execute();

        $this->assertStringContainsString("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("exclude_nudity=true", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeWithFields()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $fields = array("asset_family", "id", "uri_oembed");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withFields($fields)->execute();

        $this->assertStringContainsString("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("fields=asset_family%2Cid%2Curi_oembed", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeWithFormatFilter()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withAvailableFormat("HD")->execute();

        $this->assertStringContainsString("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("format_available=hd", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeWithFrameRates()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $rates = array("24", "29.97");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withFrameRates($rates)->execute();

        $this->assertStringContainsString("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("frame_rates=24%2C29.97", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeWithKeywordIds()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $ids = array(64284, 67255);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withKeywordIds($ids)->execute();

        $this->assertStringContainsString("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("keyword_ids=64284%2C67255", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeWithLicenseModels()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $models = array("rightsmanaged", "royaltyfree");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withLicenseModels($models)->execute();

        $this->assertStringContainsString("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("license_models=rightsmanaged%2Croyaltyfree", $curlerMock->options[CURLOPT_URL]);
    }
   
    public function testSearchVideosCreativeWithPage()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withPage(3)->execute();

        $this->assertStringContainsString("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("page=3", $curlerMock->options[CURLOPT_URL]);
    }

    
    public function testSearchVideosCreativeWithPageSize()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withPageSize(50)->execute();

        $this->assertStringContainsString("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("page_size=50", $curlerMock->options[CURLOPT_URL]);
    }
    
    public function testSearchVideosCreativeWithProductTypes()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $types = array("easyaccess", "editorialsubscription");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withProductTypes($types)->execute();

        $this->assertStringContainsString("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("product_types=easyaccess%2Ceditorialsubscription", $curlerMock->options[CURLOPT_URL]);
    }
   
    public function testSearchVideosCreativeWithSortOrder()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withSortOrder("newest")->execute();

        $this->assertStringContainsString("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("sort_order=newest", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeWithAcceptLanguage()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withAcceptLanguage("en-US")->execute();

        $this->assertStringContainsString("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("Accept-Language: en-US", $curlerMock->options[CURLOPT_HTTPHEADER]);
    }
}