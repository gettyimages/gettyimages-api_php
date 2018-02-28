<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class SearchImagesEditorialTest extends TestCase
{
    public function testSearchImagesEditorialWithPhrase()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithAgeOfPeople()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $people = array("newborn","2-3_years","0-1_months");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withAgeOfPeople($people)->withPhrase("cat")->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("age_of_people=newborn%2C2-3_years%2C0-1_months", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithArtists()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $artists = array("roman makhmutov", "Linda Raymond");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withArtists($artists)->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("artists=roman+makhmutov%2Clinda+raymond", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithCollectionCodes()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $codes = array("WRI", "ARF");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withCollectionCodes($codes)->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("collection_codes=wri%2Carf", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithCollectionFilterType()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withCollectionFilterType("exclude")->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("collections_filter_type=exclude", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithCompostitions()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $compositions = array("candid", "full_length");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withCompositions($compositions)->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("compositions=candid%2Cfull_length", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithEditorialSegments()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $edSegments = array("archival", "publicity");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withEditorialSegments($edSegments)->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("editorial_segments=archival%2Cpublicity", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithEmbedContentOnly()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withEmbedContentOnly()->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("embed_content_only=true", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithEndDate()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withEndDate("2015-04-01")->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("end_date=2015-04-01", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithEntityUris()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $uris = array("example_uri_1", "Example_uri_2");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withEntityUris($uris)->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("entity_uris=example_uri_1%2Cexample_uri_2", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithEthnicity()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $ethnicities = array("east_asian", "pacific_islander");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withEthnicity($ethnicities)->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("ethnicity=east_asian%2Cpacific_islander", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithEventIds()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $ids = array(518451, 518452);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withEventIds($ids)->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("event_ids=518451%2C518452", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithExcludeNudity()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withExcludeNudity()->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("exclude_nudity=true", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithFields()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $fields = array("asset_family", "id", "uri_oembed");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withFields($fields)->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("fields=asset_family%2Cid%2Curi_oembed", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithFileTypes()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $types = array("eps", "jpg");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withFileTypes($types)->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("file_types=eps%2Cjpg", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithGraphicalStyles()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $styles = array("fine_art", "illustration");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withGraphicalStyles($styles)->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("graphical_styles=fine_art%2Cillustration", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithKeywordIds()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $ids = array(64284, 67255);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withKeywordIds($ids)->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("keyword_ids=64284%2C67255", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithMinimumQuality()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withMinimumQualityRank(1)->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("minimum_quality_rank=1", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithMinimumSize()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withMinimumSize("small")->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("minimum_size=small", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithNumberOfPeople()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $people = array("group", "one");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withNumberOfPeople($people)->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("number_of_people=group%2Cone", $curlerMock->options[CURLOPT_URL]);
    }
    
    public function testSearchImagesEditorialWithOrientations()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $orientations = array("horizontal", "square");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withOrientations($orientations)->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("orientations=horizontal%2Csquare", $curlerMock->options[CURLOPT_URL]);
    }

    
    public function testSearchImagesEditorialWithPage()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withPage(3)->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("page=3", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithPageSize()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withPageSize(50)->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("page_size=50", $curlerMock->options[CURLOPT_URL]);
    }
    
    public function testSearchImagesEditorialWithProductTypes()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $types = array("easyaccess", "editorialsubscription");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withProductTypes($types)->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("product_types=easyaccess%2Ceditorialsubscription", $curlerMock->options[CURLOPT_URL]);
    }
  
    public function testSearchImagesEditorialWithSortOrder()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withSortOrder("newest")->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("sort_order=newest", $curlerMock->options[CURLOPT_URL]);
    }
 
    public function testSearchImagesEditorialWithSpecificPeople()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $people = array("Reggie Jackson");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withSpecificPeople($people)->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("specific_people=reggie+jackson", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesEditorialWithStartDate()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImagesEditorial()->withPhrase("cat")->withStartDate("2015-04-01")->execute();

        $this->assertContains("search/images/editorial", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("start_date=2015-04-01", $curlerMock->options[CURLOPT_URL]);
    }
}