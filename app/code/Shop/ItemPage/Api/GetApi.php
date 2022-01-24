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
            'timeout' => 3.0
        ]);
	}

    public function getResponse()
    {
        $response = $this->client->request('GET');
        return $response->getBody()->getContents();
    }

    public function getWeatherResponse()
    {
        $endpoint = 'v1/rest/datastore/F-C0032-001';
        $params = [
            'query'=>['Authorization'
                =>'CWB-2971468B-089A-4C01-86BF-C42F1F48D180']
        ];
        $response = $this->client->request('GET', $this->uri, $params);
        return $response->getBody()->getContents();
    }
}