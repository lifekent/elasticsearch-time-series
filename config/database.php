<?php


return [
    
    'connections' => [

        'elasticsearch' => [

            'http'      => env('ELASTIC_HTTP'),
            'index'     => env('ELASTIC_INDEX'),
        ]

    ],

    'mappings' => [

        'elasticsearch' => [

            'time'      => [
                'type'                  => 'date', 
                'format'                => 'epoch_second', 
                'doc_values'            => true,
            ]

        ]
    ]
];