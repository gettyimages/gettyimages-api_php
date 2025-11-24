<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class DownloadVideoTest extends TestCase
{
    public function testDownloadVideo()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadVideo()->WithId("123445")->execute();

        $this->assertStringContainsString("downloads/videos/123445", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("auto_download=false", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadVideoWithAutoDownload()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadVideo()->WithId("123445")->withAutoDownload()->execute();

        $this->assertStringContainsString("downloads/videos/123445", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("auto_download=true", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadVideoWithProductId()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadVideo()->WithId("123445")->withProductId(7758)->execute();

        $this->assertStringContainsString("downloads/videos/123445", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("product_id=7758", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadVideoWithSize()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadVideo()->WithId("123445")->withSize("hd1")->execute();

        $this->assertStringContainsString("downloads/videos/123445", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("size=hd1", $curlerMock->options[CURLOPT_URL]);
    }
}