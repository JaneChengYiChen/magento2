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
    public function getResponse()
    {
        $client = new Client([
            'base_uri' => 'http://httpbin.org',
            'timeout'  => 2.0,
        ]);
    }
}