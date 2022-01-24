<?php

namespace Shop\ItemPage\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

class GetApi
{
    public function __construct($uri)
	{
		$this->uri = $uri;
        $this->client =  new Client;
	}

    public function getResponse()
    {
        $response = $this->client->request('GET', $this->uri);
        return $response->getBody()->getContents();
    }

    public function getWeatherResponse()
    {
        $client = new Client();
    }
}