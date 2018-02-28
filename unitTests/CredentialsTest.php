<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class CredentialsTest extends TestCase
{
    public function testGetClientWithClientCredentials()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->Collections()->execute();

        $this->assertContains("test_token", $curlerMock->options[CURLOPT_HTTPHEADER][1]);
    }

    public function testGetClientWithResourceOwnderCredentials()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithResourceOwnerCredentials("", "", "", "", $container);

        $response = $client->Collections()->execute();

        $this->assertContains("test_token", $curlerMock->options[CURLOPT_HTTPHEADER][1]);
    }

    public function testGetClientWithRefreshTokenTest()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithRefreshToken("", "", "", $container);

        $response = $client->Collections()->execute();

        $this->assertContains("test_token", $curlerMock->options[CURLOPT_HTTPHEADER][1]);
    }
}