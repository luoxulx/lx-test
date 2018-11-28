<?php

return array(
    'operation_log' => [

        'enable' => true,

        /*
         * Only logging allowed methods in the list
         */
        'allowed_methods' => ['GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE', 'PATCH'],

        /*
         * Routes that will not log to database.
         *
         * All method to path like: admin/auth/logs
         * or specific method to path like: get:admin/auth/logs
         */
        'except' => [
            'admin/auth/logs*',
        ],
    ],

    'QNConfig' => [
        'token_expire' => 1800,
        'ak' => env('QI_NIU_AK'),
        'sk' => env('QI_NIU_SK'),
        'bucket' => env('QI_NIU_BUCKET'),
        'domain' => env('QI_NIU_DOMAIN'),
        'notify_url' => env('QI_NIU_NOTIFY_URL', null),
        'pic_style' => [
            'avatar' => '-avatar',
            'pic1080' => '-thumbnail1080x1080',
            'pic640' => '-thumbnail640x640',
            'pic240' => '-thumbnail300x300',
            'pic96' => '-thumbnail120x120',
            'watermark' => '-watermark',
        ]
    ]
);
