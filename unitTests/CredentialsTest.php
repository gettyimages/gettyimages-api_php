<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class CredentialsTest extends TestCase
{
    public function testGetClientWithApiKey()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithApiKey("1234", $container);

        $response = $client->Collections()->execute();

        $this->assertContains("1234", $curlerMock->options[CURLOPT_HTTPHEADER][0]);
        $this->assertNotContains("test_token", $curlerMock->options[CURLOPT_HTTPHEADER][1]);
    }

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

    public function testGetClientWithAccessTokenTest()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithAccessToken("", "", array(
            "access_token" => "test_token",
            "token_type"      => "Bearer",
            "sdk_expire_time"=> time() + 1476
        ), "", $container);

        $response = $client->Collections()->execute();

        $this->assertContains("test_token", $curlerMock->options[CURLOPT_HTTPHEADER][1]);
    }
}
