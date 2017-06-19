<?php

namespace Jeremytubbs\YPClient;

use GuzzleHttp\{Client, HandlerStack};

use Illuminate\Support\Facades\Cache;

use Jeremytubbs\YPClient\Traits\SearchClient;
use Jeremytubbs\YPClient\Traits\DetailClient;

use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\LaravelCacheStorage;
use Kevinrob\GuzzleCache\Strategy\GreedyCacheStrategy;

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
        $cacheDriver = isset($this->config['cacheDriver']) ? $this->config['cacheDriver'] : config('cache.default');
        $TTL = isset($this->config['TTL']) ? $this->config['TTL'] : 82800;

        $stack = HandlerStack::create();

        $stack->push(
            new CacheMiddleware(
                new GreedyCacheStrategy(
                    new LaravelCacheStorage(
                        Cache::store($cacheDriver)
                    ),
                    $TTL
                )
            ),
            'cache'
        );

        return new Client([
            'handler' => $stack,
            'base_uri' => $this->config['api_endpoint']
        ]);
    }

    public function handle($response)
    {
        $body = $response->getBody();
        return $body->getContents();
    }
}
