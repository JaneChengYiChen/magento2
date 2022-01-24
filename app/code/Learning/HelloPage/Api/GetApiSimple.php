<?php

namespace Learning\HelloPage\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientFactory;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ResponseFactory;
use Magento\Framework\Webapi\Rest\Request;

/**
 * Class GitApiService
 */
class GetApiSimple
{
    const baseUri = 'https://api.github.com';

    public function getResponse()
    {
        $client = new Client([
            'base_uri' => static::baseUri,
            'timeout'  => 2.0,
        ]);

        $response = $client->request('GET', '/repos/magento/magento2');
        return $response->getBody()->getContents();
    }
}