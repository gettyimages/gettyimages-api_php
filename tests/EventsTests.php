<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class EventsTest extends TestCase
{
    // public function testEventsEndpointWithId(): void
    // {
    //     $curlerMock = new CurlerMock();
    //     $builder = new \DI\ContainerBuilder();
    //     $container = $builder->build();
    //     $container->set('ICurler', $curlerMock);

    //     $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

    //     $response = $client->Events()->WithId(12345)->execute();

    //     $this->assertContains("events/12345", $curlerMock->options[CURLOPT_URL]);
    // }

    // public function testEventsEndpointWithIds(): void
    // {
    //     $curlerMock = new CurlerMock();
    //     $builder = new \DI\ContainerBuilder();
    //     $container = $builder->build();
    //     $container->set('ICurler', $curlerMock);

    //     $ids = array(775051817, 775072327, 775114230);

    //     $client = GettyImages_Client::getClientWithClientCredentials("qkc3ccsppa8bx4fqpaw7duzz", "UndzXjVQZTctNxuJKhbc3AudTx7SMXvbF4d44nTTPdD4k");

    //     $response = $client->Events()->WithIds($ids)->execute();

    //     $this->assertContains("events", $curlerMock->options[CURLOPT_URL]);
    //     $this->assertContains("ids=12345%2C23456%2C34567", $curlerMock->options[CURLOPT_URL]);
    // }
}