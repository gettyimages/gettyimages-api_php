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
        $this->assertContains("age_of_people=newborn,2-3_years,0-1_months", $curlerMock->options[CURLOPT_URL]);
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
        $this->assertContains("artists=roman+makhmutov,linda+raymond", $curlerMock->options[CURLOPT_URL]);
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
        $this->assertContains("collection_codes=WRI,ARF", $curlerMock->options[CURLOPT_URL]);
    }

    // public function testSearchImagesWithCollectionFilterType(): void
    // {
    //     $curlerMock = new CurlerMock();
    //     $builder = new \DI\ContainerBuilder();
    //     $container = $builder->build();
    //     $container->set('ICurler', $curlerMock);

    //     $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

    //     $search = $client->SearchImages()->withArtists("abcd")->withArtists($artists2)->execute();

    //     $this->assertContains("countries", $curlerMock->options[CURLOPT_URL]);
    // }

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
        $this->assertContains("color=002244", $curlerMock->options[CURLOPT_URL]);
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
        $this->assertContains("compositions=candid,full_length", $curlerMock->options[CURLOPT_URL]);
    }
}