<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class SearchVideosEditorialTest extends TestCase
{
    public function testSearchVideosEditorialWithPhrase()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->execute();

        $this->assertStringContainsString("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosEditorialWithAgeOfPeople()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $people = array("newborn","2-3_years","0-1_months");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withAgeOfPeople($people)->withPhrase("cat")->execute();

        $this->assertStringContainsString("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("age_of_people=newborn%2C2-3_years%2C0-1_months", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosEditorialWithCollectionCodes()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $codes = array("WRI", "ARF");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withCollectionCodes($codes)->execute();

        $this->assertStringContainsString("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("collection_codes=wri%2Carf", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosEditorialWithCollectionFilterType()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withCollectionFilterType("exclude")->execute();

        $this->assertStringContainsString("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("collections_filter_type=exclude", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosEditorialWithEditorialVideoTypes()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $types = array("raw", "produced");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withEditorialVideoTypes($types)->execute();

        $this->assertStringContainsString("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("editorial_video_types=raw%2Cproduced", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosEntityUris()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $uris = array("example_uri_1", "Example_uri_2");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withEntityUris($uris)->execute();

        $this->assertStringContainsString("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("entity_uris=example_uri_1%2Cexample_uri_2", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosEditorialWithExcludeNudity()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withExcludeNudity()->execute();

        $this->assertStringContainsString("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("exclude_nudity=true", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosEditorialWithFields()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $fields = array("asset_family", "id", "uri_oembed");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withFields($fields)->execute();

        $this->assertStringContainsString("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("fields=asset_family%2Cid%2Curi_oembed", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosEditorialWithFormatFilter()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withAvailableFormat("HD")->execute();

        $this->assertStringContainsString("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("format_available=hd", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosEditorialWithFrameRates()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $rates = array("24", "29.97");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withFrameRates($rates)->execute();

        $this->assertStringContainsString("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("frame_rates=24%2C29.97", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosEditorialWithKeywordIds()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $ids = array(64284, 67255);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withKeywordIds($ids)->execute();

        $this->assertStringContainsString("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("keyword_ids=64284%2C67255", $curlerMock->options[CURLOPT_URL]);
    }
   
    public function testSearchVideosEditorialWithPage()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withPage(3)->execute();

        $this->assertStringContainsString("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("page=3", $curlerMock->options[CURLOPT_URL]);
    }

    
    public function testSearchVideosEditorialWithPageSize()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withPageSize(50)->execute();

        $this->assertStringContainsString("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("page_size=50", $curlerMock->options[CURLOPT_URL]);
    }
    
    public function testSearchVideosEditorialWithProductTypes()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $types = array("easyaccess", "editorialsubscription");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withProductTypes($types)->execute();

        $this->assertStringContainsString("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("product_types=easyaccess%2Ceditorialsubscription", $curlerMock->options[CURLOPT_URL]);
    }
    
    public function testSearchVideosEditorialWithSortOrder()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withSortOrder("newest")->execute();

        $this->assertStringContainsString("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("sort_order=newest", $curlerMock->options[CURLOPT_URL]);
    }
 
    public function testSearchVideosEditorialWithSpecificPeople()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $people = array("Reggie Jackson");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withSpecificPeople($people)->execute();

        $this->assertStringContainsString("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("specific_people=reggie+jackson", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosEditorialWithAcceptLanguage()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withAcceptLanguage("en-US")->execute();

        $this->assertStringContainsString("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("Accept-Language: en-US", $curlerMock->options[CURLOPT_HTTPHEADER]);
    }
}