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

    // bai du translate
    'bd_translate' => [
        'app_id' => env('BD_TRANSLATE_ID'),
        'secret_key' => env('BD_TRANSLATE_SK'),
        'url' => 'https://api.fanyi.baidu.com/api/trans/vip/translate?',
    ],

    /*
     |--------------------------------------------------------------------------
     | Pattern and storage path settings
     |--------------------------------------------------------------------------
     |
     | The env key for pattern and storage path with a default value
     |
     */
    'pattern' => env('LOGVIEWER_PATTERN', '*.log'),
    'storage_path' => env('LOGVIEWER_STORAGE_PATH', storage_path('logs')),
);
