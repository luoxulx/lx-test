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

    'qiniu_config' => [
        'ak' => env('QI_NIU_AK'),
        'sk' => env('QI_NIU_SK'),
        'bucket' => env('QI_NIU_BUCKET'),
        'domain' => env('QI_NIU_DOMAIN'),
        'notify_url' => env('QI_NIU_NOTIFY_URL', null),
    ],

    'bd_translate' => [
        'app_id' => env('BD_TRANSLATE_ID'),
        'secret_key' => env('BD_TRANSLATE_SK'),
        'url' => 'https://api.fanyi.baidu.com/api/trans/vip/translate?',
    ],
);
