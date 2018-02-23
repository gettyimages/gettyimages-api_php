<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class VideosSimilarSimilarTest extends TestCase
{
    public function testVideosSimilarEndpointWithId(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->VideosSimilar()->WithId(12345)->execute();

        $this->assertContains("videos/12345/similar", $curlerMock->options[CURLOPT_URL]);
    }  
    
    public function testSingleEventWithFields(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $fields = array("id", "image_count");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->VideosSimilar()->WithId(12345)->withFields($fields)->execute();

        $this->assertContains("videos/12345/similar", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("fields=id%2Cimage_count", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSingleEventWithPage(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->VideosSimilar()->WithId(12345)->withPage(3)->execute();

        $this->assertContains("videos/12345/similar", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("page=3", $curlerMock->options[CURLOPT_URL]);
    }

    public function testSingleEventWithPageSize(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->VideosSimilar()->WithId(12345)->withPageSize(50)->execute();

        $this->assertContains("videos/12345/similar", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("page_size=50", $curlerMock->options[CURLOPT_URL]);
    }
}