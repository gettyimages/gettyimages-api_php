<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class TESTING extends TestCase
{
    public function testCountriesEndpoint(): void
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "");

        $response = $client->SearchImages()->withOrientations(array("horizontal"))->execute();

        $this->assertContains("countries", $curlerMock->options[CURLOPT_URL]);
    }
}