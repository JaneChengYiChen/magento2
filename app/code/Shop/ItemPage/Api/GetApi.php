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
        $this->client =  new Client([
            'base_uri' => $uri,
            'timeout' => 5.0
        ]);
	}

    public function getResponse()
    {
        $response = $this->client->request('GET');
        return $response->getBody()->getContents();
    }

    public function getWeatherResponse()
    {
        $params = [
            'query'=>['Authorization' => GetAuth::weatherAuth]
        ];
        $response = $this->client->request('GET', $this->uri, $params);
        return $response->getBody()->getContents();
    }
}