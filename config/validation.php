<?php

/**
 * Validation rules
 */

return [
    
    'stats' => [

        /**
         * Events tracking
         */

        'track' => [

            'pulse' => [

                'event'         => 'required',
            ],
        ],

        /**
         * Events reports
         */
        
        'report' => [

            'count' => [

                'event'         => 'required'
            ],

            'histogram' => [

                'event'         => 'required',
                'interval'      => 'required|in:year,quarter,month,week,day,hour,minute,second'
            ],        

        ]
    ]

];