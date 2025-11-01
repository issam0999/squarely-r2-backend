<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],

    'allowed_origins' => ['http://localhost:5173', 'http://127.0.0.1:5173'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['X-Requested-With', 'Content-Type', 'X-Token-Auth', 'Authorization', 'X-XSRF-TOKEN', 'X-CSRF-TOKEN', 'Accept'],

    'exposed_headers' => ['Authorization'],

    'max_age' => 60 * 60 * 24,

    'supports_credentials' => true,
];
