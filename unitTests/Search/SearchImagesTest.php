<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class SearchImagesTest extends TestCase
{
    public function testSearchImagesWithPhrase(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesWithAgeOfPeople(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $people = array("newborn","2-3_years","0-1_months");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withAgeOfPeople($people)->withPhrase("cat")->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("age_of_people=newborn%2C2-3_years%2C0-1_months", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesWithArtists(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $artists = array("roman makhmutov", "Linda Raymond");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withArtists($artists)->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("artists=roman+makhmutov%2Clinda+raymond", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesWithCollectionCodes(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $codes = array("WRI", "ARF");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withCollectionCodes($codes)->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("collection_codes=wri%2Carf", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesWithCollectionFilterType(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withCollectionFilterType("exclude")->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("collections_filter_type=exclude", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesWithColor(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withColor("#002244")->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("color=%23002244", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesWithCompostitions(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $compositions = array("candid", "full_length");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withCompositions($compositions)->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("compositions=candid%2Cfull_length", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesWithEmbedContentOnly(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withEmbedContentOnly()->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("embed_content_only=true", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesWithEthnicity(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $ethnicities = array("east_asian", "pacific_islander");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withEthnicity($ethnicities)->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("ethnicity=east_asian%2Cpacific_islander", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesWithEventIds(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $ids = array(518451, 518452);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withEventIds($ids)->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("event_ids=518451%2C518452", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesWithEventIdsChainedDuplicates(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $ids = array(518451, 518452);

        $ids2 = array(518451, 518452);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withEventIds($ids)->withEventIds($ids2)->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("event_ids=518451%2C518452", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesWithEventIdsChained(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $ids = array(518451, 518452);

        $ids2 = array(518453, 518454);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withEventIds($ids)->withEventIds($ids2)->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("event_ids=518451%2C518452%2C518453%2C518454", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesWithExcludeNudity(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withExcludeNudity()->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("exclude_nudity=true", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesWithFields(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $fields = array("asset_family", "id", "uri_oembed");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withFields($fields)->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("fields=asset_family%2Cid%2Curi_oembed", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesWithFileTypes(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $types = array("eps", "jpg");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withFileTypes($types)->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("file_types=eps%2Cjpg", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesWithGraphicalStyles(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $styles = array("fine_art", "illustration");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withGraphicalStyles($styles)->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("graphical_styles=fine_art%2Cillustration", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesWithKeywordIds(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $ids = array(64284, 67255);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withKeywordIds($ids)->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("keyword_ids=64284%2C67255", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesWithLicenseModels(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $models = array("rightsmanaged", "royaltyfree");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withLicenseModels($models)->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("license_models=rightsmanaged%2Croyaltyfree", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesWithMinimumSize(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withMinimumSize("small")->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("minimum_size=small", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSearchImagesWithNumberOfPeople(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $people = array("group", "one");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withNumberOfPeople($people)->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("number_of_people=group%2Cone", $curlerMock->options[CURLOPT_URL]);
    }
  
    public function testSearchImagesWithOrientations(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $orientations = array("horizontal", "square");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withOrientations($orientations)->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("orientations=horizontal%2Csquare", $curlerMock->options[CURLOPT_URL]);
    }

    
    public function testSearchImagesWithPage(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withPage(3)->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("page=3", $curlerMock->options[CURLOPT_URL]);
    }

    
    public function testSearchImagesWithPageSize(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withPageSize(50)->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("page_size=50", $curlerMock->options[CURLOPT_URL]);
    }

    
    public function testSearchImagesWithPrestigeContent(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withPrestigeContentOnly()->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("prestige_content_only=true", $curlerMock->options[CURLOPT_URL]);
    }

    
    public function testSearchImagesWithProductTypes(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $types = array("easyaccess", "editorialsubscription");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withProductTypes($types)->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("product_types=easyaccess%2Ceditorialsubscription", $curlerMock->options[CURLOPT_URL]);
    }
    
    public function testSearchImagesWithSortOrder(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withSortOrder("newest")->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("sort_order=newest", $curlerMock->options[CURLOPT_URL]);
    }
   
    public function testSearchImagesWithSpecificPeople(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $people = array("Reggie Jackson");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $search = $client->SearchImages()->withPhrase("cat")->withSpecificPeople($people)->execute();

        $this->assertContains("search/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("phrase=cat", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("specific_people=reggie+jackson", $curlerMock->options[CURLOPT_URL]);
    }
}