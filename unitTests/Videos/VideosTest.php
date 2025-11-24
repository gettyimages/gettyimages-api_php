<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class VideosTest extends TestCase
{
    public function testVideosWithId()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->Videos()->WithId(12345)->execute();

        $this->assertStringContainsString("videos/12345", $curlerMock->options[CURLOPT_URL]);
    }

    public function testVideosWithIds()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $ids = array(775051817, 775072327, 775114230);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->Videos()->WithIds($ids)->execute();

        $this->assertStringContainsString("videos", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("ids=775051817%2C775072327%2C775114230", $curlerMock->options[CURLOPT_URL]);
    }  
    
    public function testVideosWithFields()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $fields = array("id", "image_count");

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->Videos()->WithId(12345)->withFields($fields)->execute();

        $this->assertStringContainsString("videos/12345", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("fields=id%2Cimage_count", $curlerMock->options[CURLOPT_URL]);
    }
}