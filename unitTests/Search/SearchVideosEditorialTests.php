<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class SearchVideosEditorialTest extends TestCase
{
    public function testSearchVideosEditorialWithPhrase(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->execute();

        $this->assertContains("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosEditorialWithAgeOfPeople(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $people = array("newborn","2-3_years","0-1_months");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withAgeOfPeople($people)->withPhrase("cat")->execute();

        $this->assertContains("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("age_of_people=newborn%2C2-3_years%2C0-1_months", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosEditorialWithCollectionCodes(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $codes = array("WRI", "ARF");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withCollectionCodes($codes)->execute();

        $this->assertContains("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("collection_codes=wri%2Carf", $curlerMock->options[CURLOPT_URL]);
    }

    // public function testSearchVideosEditorialWithCollectionFilterType(): void
    // {
    //     $curlerMock = new CurlerMock();
    //     $builder = new \DI\ContainerBuilder();
    //     $container = $builder->build();
    //     $container->set('ICurler', $curlerMock);

    //     $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

    //     $search = $client->SearchVideosEditorial()->withArtists("abcd")->withArtists($artists2)->execute();

    //     $this->assertContains("countries", $curlerMock->options[CURLOPT_URL]);
    // }

    public function testSearchVideosEditorialWithEditorialVideoTypes(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $types = array("raw", "produced");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withEditorialVideoTypes($types)->execute();

        $this->assertContains("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("editorial_video_types=raw%2Cproduced", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosEntityUris(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $uris = array("example_uri_1", "Example_uri_2");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withEntityUris($uris)->execute();

        $this->assertContains("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("entity_uris=example_uri_1%2Cexample_uri_2", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosEditorialWithExcludeNudity(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withExcludeNudity()->execute();

        $this->assertContains("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("exclude_nudity=true", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosEditorialWithFields(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $fields = array("asset_family", "id", "uri_oembed");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withFields($fields)->execute();

        $this->assertContains("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("fields=asset_family%2Cid%2Curi_oembed", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosEditorialWithFormatFilter(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withAvailableFormat("HD")->execute();

        $this->assertContains("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("format_available=hd", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosEditorialWithFrameRates(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $rates = array("24", "29.97");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withFrameRates($rates)->execute();

        $this->assertContains("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("frame_rates=24%2C29.97", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosEditorialWithKeywordIds(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $ids = array(64284, 67255);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withKeywordIds($ids)->execute();

        $this->assertContains("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("keyword_ids=64284%2C67255", $curlerMock->options[CURLOPT_URL]);
    }
   
    public function testSearchVideosEditorialWithPage(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withPage(3)->execute();

        $this->assertContains("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("page=3", $curlerMock->options[CURLOPT_URL]);
    }

    
    public function testSearchVideosEditorialWithPageSize(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withPageSize(50)->execute();

        $this->assertContains("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("page_size=50", $curlerMock->options[CURLOPT_URL]);
    }
    
    public function testSearchVideosEditorialWithProductTypes(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $types = array("easyaccess", "editorialsubscription");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withProductTypes($types)->execute();

        $this->assertContains("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("product_types=easyaccess%2Ceditorialsubscription", $curlerMock->options[CURLOPT_URL]);
    }

    
    // public function testSearchVideosEditorialWithSortOrder(): void
    // {
    //     $curlerMock = new CurlerMock();
    //     $builder = new \DI\ContainerBuilder();
    //     $container = $builder->build();
    //     $container->set('ICurler', $curlerMock);

    //     $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

    //     $search = $client->SearchVideosEditorial()->withPhrase("cat")->withSortOrder("newest")->execute();

    //     $this->assertContains("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
    //     $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
    //     $this->assertContains("sort_order=newest", $curlerMock->options[CURLOPT_URL]);
    // }

    
    public function testSearchVideosEditorialWithSpecificPeople(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $people = array("Reggie Jackson");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosEditorial()->withPhrase("cat")->withSpecificPeople($people)->execute();

        $this->assertContains("search/videos/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("specific_people=reggie+jackson", $curlerMock->options[CURLOPT_URL]);
    }
}