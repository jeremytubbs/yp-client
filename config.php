<?php

return [

    'api_endpoint' => 'http://api2.yp.com',

    'api_key' => env('YP_KEY'),

    'return_format' => 'json', // or xml

    'default_sort'  => 'distance',  // or name

    'defaults' => [
        'location' => '46204',
        'term' => 'Hospitals',
        'radius' => 25,
        'count' => 50,
        'pagenum' => 1,
    ];

];
