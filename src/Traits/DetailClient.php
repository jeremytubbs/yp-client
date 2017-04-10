<?php

namespace Jeremytubbs\YPClient\Traits;

trait DetailClient
{
    public function getDetails($id)
    {
        $query = [
            'listingid' => $id,
            'format' => 'json',
            'key' => env('YP_KEY'),
        ];

        $response = $this->client->request('GET', 'details/v1/search', [
            'query' => $query
        ]);

        return $this->handle($response);
    }

}
