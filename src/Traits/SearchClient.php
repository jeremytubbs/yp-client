<?php

namespace Jeremytubbs\YPClient\Traits;

trait SearchClient
{
    public function getListings($location, $term, $page = 1, $radius = 25, $count = 50)
    {
        /** Valid formats for searchloc **/
        // city, state (example: searchloc=Glendale%2C+CA)
        // zip code (example: searchloc=91203)
        // lat:long (example: searchloc=37.7752%3A-122.4192 for San Francisco,CA)
        // street1 and street2, city, state (example: searchloc=olive+and+san+fernando%2C+burbank+CA)
        // street1 and street2, zip (example: searchloc=olive+and+san+fernando%2C+91502)
        // street, zip (example: searchloc=611+North+Brand%2C+91203)
        // street, city, state (example: searchloc=611+North+Brand%2C+Glendale+CA)
        // neighborhood, city, state (example: searchloc=chinatown%2C+san+francisco%2C+CA)
        // point of interest, city, state (example: searchloc=golden+gate+bridge%2C+san+francisco%2C+CA)

        $query = [
            'searchloc' => $location,
            'term' => $term,
            'radius' => $radius,
            'sort' => 'distance',
            'format' => 'json',
            'listingcount' => $count,
            'pagenum' => $page,
            'key' => env('YP_KEY'),
        ];

        $response = $this->client->request('GET', 'listings/v1/search', [
            'query' => $query
        ]);

        return $this->handle($response);
    }

}
