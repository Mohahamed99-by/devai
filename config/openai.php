<?php

return [
    'api_key' => env('OPENAI_API_KEY'),
    'organization' => env('OPENAI_ORGANIZATION'),
    'model' => env('OPENAI_MODEL', 'gpt-4'),
    'http' => [
        'timeout' => 30,
        'verify' => false, // Disable SSL verification for local development
    ],
];