<?php


return [
    
    'connections' => [

        'elasticsearch' => [

            'http'      => env('ELASTIC_HTTP'),
            'index'     => env('ELASTIC_INDEX'),
        ]

    ]
];