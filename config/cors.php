<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */

    'supportsCredentials' => false,
    'allowedOrigins' => ['*'],
    'allowedOriginsPatterns' => [],
    'allowedHeaders' => ['Content-Type','Authorization','Access-Key'],
    'allowedMethods' => ['GET', 'POST', 'OPTIONS', 'PUT', 'DELETE'],
    'exposedHeaders' => [],
    'maxAge' => 0,

];
