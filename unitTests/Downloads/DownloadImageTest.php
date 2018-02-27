<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class DownloadImageTest extends TestCase
{
    public function testDownloadImage(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadImage()->WithId("629219532")->execute();

        $this->assertContains("downloads/images/123445", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("auto_download=false", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadImageWithAutoDownload(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadImage()->WithId("123445")->withAutoDownload()->execute();

        $this->assertContains("downloads/images/123445", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("auto_download=true", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadImageWithFileType(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadImage()->WithId("123445")->withFileType("eps")->execute();

        $this->assertContains("downloads/images/123445", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("file_type=eps", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadImageWithHeight(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadImage()->WithId("123445")->withHeight("592")->execute();

        $this->assertContains("downloads/images/123445", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("height=592", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadImageWithProductId(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadImage()->WithId("123445")->withProductId(7758)->execute();

        $this->assertContains("downloads/images/123445", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("product_id=7758", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadImageWithProductType(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadImage()->WithId("123445")->withProductType("easyaccess")->execute();

        $this->assertContains("downloads/images/123445", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("product_type=easyaccess", $curlerMock->options[CURLOPT_URL]);
    }
}