<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class SearchVideosCreativeTest extends TestCase
{
    public function testSearchVideosCreativeWithPhrase(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->execute();

        $this->assertContains("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeWithAgeOfPeople(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $people = array("newborn","2-3_years","0-1_months");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withAgeOfPeople($people)->withPhrase("cat")->execute();

        $this->assertContains("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("age_of_people=newborn%2C2-3_years%2C0-1_months", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeWithCollectionCodes(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $codes = array("WRI", "ARF");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withCollectionCodes($codes)->execute();

        $this->assertContains("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("collection_codes=wri%2Carf", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeWithCollectionFilterType(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withCollectionFilterType("exclude")->execute();

        $this->assertContains("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("collections_filter_type=exclude", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeWithExcludeNudity(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withExcludeNudity()->execute();

        $this->assertContains("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("exclude_nudity=true", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeWithFields(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $fields = array("asset_family", "id", "uri_oembed");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withFields($fields)->execute();

        $this->assertContains("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("fields=asset_family%2Cid%2Curi_oembed", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeWithFormatFilter(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withAvailableFormat("HD")->execute();

        $this->assertContains("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("format_available=hd", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeWithFrameRates(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $rates = array("24", "29.97");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withFrameRates($rates)->execute();

        $this->assertContains("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("frame_rates=24%2C29.97", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeWithKeywordIds(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $ids = array(64284, 67255);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withKeywordIds($ids)->execute();

        $this->assertContains("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("keyword_ids=64284%2C67255", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchVideosCreativeWithLicenseModels(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $models = array("rightsmanaged", "royaltyfree");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withLicenseModels($models)->execute();

        $this->assertContains("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("license_models=rightsmanaged%2Croyaltyfree", $curlerMock->options[CURLOPT_URL]);
    }
   
    public function testSearchVideosCreativeWithPage(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withPage(3)->execute();

        $this->assertContains("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("page=3", $curlerMock->options[CURLOPT_URL]);
    }

    
    public function testSearchVideosCreativeWithPageSize(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withPageSize(50)->execute();

        $this->assertContains("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("page_size=50", $curlerMock->options[CURLOPT_URL]);
    }
    
    public function testSearchVideosCreativeWithProductTypes(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $types = array("easyaccess", "editorialsubscription");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withProductTypes($types)->execute();

        $this->assertContains("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("product_types=easyaccess%2Ceditorialsubscription", $curlerMock->options[CURLOPT_URL]);
    }
   
    public function testSearchVideosCreativeWithSortOrder(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchVideosCreative()->withPhrase("cat")->withSortOrder("newest")->execute();

        $this->assertContains("search/videos/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("sort_order=newest", $curlerMock->options[CURLOPT_URL]);
    }
}