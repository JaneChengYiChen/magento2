<?php

namespace Shop\ItemPage\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

class GetApi
{
    const baseUri = 'https://tw.rter.info/capi.php';

    public function getResponse()
    {
        $client = new Client([
            'base_uri' => static::baseUri,
            'timeout'  => 2.0,
        ]);

        $response = $client->request('GET');
        return $response->getBody()->getContents();
    }
}