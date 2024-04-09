<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    // 'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // 'allowed_methods' => ['*'],

    // 'allowed_origins' => ['*'],

    // 'allowed_origins_patterns' => [],

    // 'allowed_headers' => ['*'],

    // 'exposed_headers' => [],

    // 'max_age' => 0,

    // 'supports_credentials' => false,

    
        'paths' => ['api/*'], // Rutas que deben ser afectadas por CORS, puedes ajustarlas según tus necesidades
        'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE'], // Métodos permitidos
        'allowed_origins' => ['http://localhost:5173'], // Orígenes permitidos
        'allowed_origins_patterns' => [],
        'allowed_headers' => ['Content-Type', 'Authorization','enctype'],
        'exposed_headers' => [],
        'max_age' => 0,
        'supports_credentials' => false,

];
