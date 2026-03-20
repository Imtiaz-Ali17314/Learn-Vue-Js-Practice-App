<?php

return [

    'paths' => ['sanctum/csrf-cookie', 'api/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['http://localhost:8080'],

    'allowed_headers' => ['*'],

    'supports_credentials' => true, // VERY IMPORTANT

    'exposed_headers' => [],
    'max_age' => 0,
];

