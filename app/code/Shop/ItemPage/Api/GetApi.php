<?php

namespace Shop\ItemPage\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

class GetApi
{
    const baseUri = 'https://openapi.taifex.com.tw';

    public function getResponse()
    {
        $client = new Client([
            'base_uri' => static::baseUri,
            'timeout'  => 2.0,
        ]);

        $response = $client->request('GET', '/v1/SSFRefferedOpeningPrice');
        return $response->getBody()->getContents();
    }
}