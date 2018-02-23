<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class DownloadImageTest extends TestCase
{
    public function testDownloadImageEndpoint(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadImage()->execute();

        $this->assertContains("downloads", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadImageEndpointWithCompanyDownloadImage(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadImage()->withCompanyDownloadImage()->execute();

        $this->assertContains("downloads", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("company_downloads=true", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadImageEndpointWithEndDate(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadImage()->withEndDate("2015-04-01")->execute();

        $this->assertContains("downloads", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("end_date=2015-04-01", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadImageEndpointWithPage(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadImage()->withPage(3)->execute();

        $this->assertContains("downloads", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("page=3", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadImageEndpointWithPageSize(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadImage()->withPageSize(50)->execute();

        $this->assertContains("downloads", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("page_size=50", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadImageEndpointWithProductType(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadImage()->withProductType("easyaccess")->execute();

        $this->assertContains("downloads", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("product_type=easyaccess", $curlerMock->options[CURLOPT_URL]);
    }

    public function testDownloadImageEndpointWithStartDate(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->DownloadImage()->withStartDate("2015-04-01")->execute();

        $this->assertContains("downloads", $curlerMock->options[CURLOPT_URL]);
        $this->assertContains("start_date=2015-04-01", $curlerMock->options[CURLOPT_URL]);
    }
}