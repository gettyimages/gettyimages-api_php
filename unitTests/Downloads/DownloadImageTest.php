<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class DownloadImageTest extends TestCase
{
    public function testDownloadImage()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadImage()->WithId("123445")->execute();

        $this->assertStringContainsString("downloads/images/123445", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("auto_download=false", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadImageWithAutoDownload()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadImage()->WithId("123445")->withAutoDownload()->execute();

        $this->assertStringContainsString("downloads/images/123445", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("auto_download=true", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadImageWithFileType()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadImage()->WithId("123445")->withFileType("eps")->execute();

        $this->assertStringContainsString("downloads/images/123445", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("file_type=eps", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadImageWithHeight()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadImage()->WithId("123445")->withHeight("592")->execute();

        $this->assertStringContainsString("downloads/images/123445", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("height=592", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadImageWithProductId()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadImage()->WithId("123445")->withProductId(7758)->execute();

        $this->assertStringContainsString("downloads/images/123445", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("product_id=7758", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadImageWithProductType()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadImage()->WithId("123445")->withProductType("easyaccess")->execute();

        $this->assertStringContainsString("downloads/images/123445", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("product_type=easyaccess", $curlerMock->options[CURLOPT_URL]);
    }
}