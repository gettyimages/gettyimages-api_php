<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class SearchImagesCreativeTest extends TestCase
{
    public function testSearchImagesCreativeWithPhrase()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeWithAgeOfPeople()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $people = array("newborn","2-3_years","0-1_months");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withAgeOfPeople($people)->withPhrase("cat")->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("age_of_people=newborn%2C2-3_years%2C0-1_months", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeWithArtists()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $artists = array("roman makhmutov", "Linda Raymond");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->withArtists($artists)->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("artists=roman+makhmutov%2Clinda+raymond", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeWithCollectionCodes()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $codes = array("WRI", "ARF");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->withCollectionCodes($codes)->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("collection_codes=wri%2Carf", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeWithCollectionFilterType()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->withCollectionFilterType("exclude")->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("collections_filter_type=exclude", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeWithColor()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->withColor("#002244")->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("color=%23002244", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeWithCompostitions()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $compositions = array("candid", "full_length");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->withCompositions($compositions)->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("compositions=candid%2Cfull_length", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeWithEmbedContentOnly()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->withEmbedContentOnly()->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("embed_content_only=true", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeWithEthnicity()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $ethnicities = array("east_asian", "pacific_islander");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->withEthnicity($ethnicities)->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("ethnicity=east_asian%2Cpacific_islander", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeWithExcludeNudity()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->withExcludeNudity()->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("exclude_nudity=true", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeWithFields()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $fields = array("asset_family", "id", "uri_oembed");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->withFields($fields)->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("fields=asset_family%2Cid%2Curi_oembed", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeWithFileTypes()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $types = array("eps", "jpg");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->withFileTypes($types)->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("file_types=eps%2Cjpg", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeWithGraphicalStyles()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $styles = array("fine_art", "illustration");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->withGraphicalStyles($styles)->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("graphical_styles=fine_art%2Cillustration", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeWithKeywordIds()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $ids = array(64284, 67255);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->withKeywordIds($ids)->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("keyword_ids=64284%2C67255", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeWithMinimumSize()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->withMinimumSize("small")->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("minimum_size=small", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeWithNumberOfPeople()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $people = array("group", "one");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->withNumberOfPeople($people)->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("number_of_people=group%2Cone", $curlerMock->options[CURLOPT_URL]);
    }

    
    public function testSearchImagesCreativeWithOrientations()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $orientations = array("horizontal", "square");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->withOrientations($orientations)->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("orientations=horizontal%2Csquare", $curlerMock->options[CURLOPT_URL]);
    }

    
    public function testSearchImagesCreativeWithPage()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->withPage(3)->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("page=3", $curlerMock->options[CURLOPT_URL]);
    }

    
    public function testSearchImagesCreativeWithPageSize()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->withPageSize(50)->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("page_size=50", $curlerMock->options[CURLOPT_URL]);
    }

    
    public function testSearchImagesCreativeWithPrestigeContent()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->withPrestigeContentOnly()->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("prestige_content_only=true", $curlerMock->options[CURLOPT_URL]);
    }

    
    public function testSearchImagesCreativeWithProductTypes()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $types = array("easyaccess", "editorialsubscription");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->withProductTypes($types)->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("product_types=easyaccess%2Ceditorialsubscription", $curlerMock->options[CURLOPT_URL]);
    }

    
    public function testSearchImagesCreativeWithSortOrder()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withPhrase("cat")->withSortOrder("newest")->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("sort_order=newest", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesCreativeWithAcceptLanguage()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesCreative()->withAcceptLanguage("en-US")->execute();

        $this->assertContains("search/images/creative", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("Accept-Language: en-US", $curlerMock->options[CURLOPT_HTTPHEADER]);
    }
}