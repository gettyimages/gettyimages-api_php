<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class VideosSimilarTest extends TestCase
{
    public function testVideosSimilarWithId()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->VideosSimilar()->WithId(12345)->execute();

        $this->assertStringContainsString("videos/12345/similar", $curlerMock->options[CURLOPT_URL]);
    }  
    
    public function testSingleEventWithFields()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $fields = array("id", "image_count");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->VideosSimilar()->WithId(12345)->withFields($fields)->execute();

        $this->assertStringContainsString("videos/12345/similar", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("fields=id%2Cimage_count", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSingleEventWithPage()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->VideosSimilar()->WithId(12345)->withPage(3)->execute();

        $this->assertStringContainsString("videos/12345/similar", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("page=3", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSingleEventWithPageSize()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->VideosSimilar()->WithId(12345)->withPageSize(50)->execute();

        $this->assertStringContainsString("videos/12345/similar", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("page_size=50", $curlerMock->options[CURLOPT_URL]);
    }
}