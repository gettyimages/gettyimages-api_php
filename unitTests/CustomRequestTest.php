<?php

use PHPUnit\Framework\TestCase;
use GettyImages\Api\GettyImages_Client;
use GettyImages\Api\Curler\CurlerMock;

final class CustomRequestTest extends TestCase
{
    public function testCustomRequest()
    {
        $curlerMock = new CurlerMock();
        $builder = new \DI\ContainerBuilder();
        $container = $builder->build();
        $container->set('ICurler', $curlerMock);

        $client = GettyImages_Client::getClientWithClientCredentials("", "", $container);

        $response = $client->CustomRequest()->WithRoute("artists/images")->withMethod("get")->withQueryParameters(array("artist_name" => "roman makhmutov", "page" => 3, "page_size" => 50))->execute();

        $this->assertStringContainsString("artists/images", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("artist_name=roman+makhmutov", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("page=3", $curlerMock->options[CURLOPT_URL]);
        $this->assertStringContainsString("page_size=50", $curlerMock->options[CURLOPT_URL]);
    }  
    
}