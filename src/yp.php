<?php

namespace Jeremytubbs\YPClient;

use GuzzleHttp\Client;

use Jeremytubbs\YPClient\Traits\SearchClient;
use Jeremytubbs\YPClient\Traits\DetailClient;

class YP
{
    use SearchClient, DetailClient;

    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
        $this->client = $this->setClient();
    }

    public function setClient()
    {
        return new Client([
            'base_uri' => $this->config['api_endpoint']
        ]);
    }

    public function handle($response)
    {
        $body = $response->getBody();
        return $body->getContents();
    }
}
