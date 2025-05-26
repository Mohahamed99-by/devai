<?php

return [
    'api_key' => env('OPENAI_API_KEY'),
    'organization' => env('OPENAI_ORGANIZATION'),
    'model' => env('OPENAI_MODEL', 'gpt-3.5-turbo'), // Changé de gpt-4 à gpt-3.5-turbo pour plus de rapidité
    'http' => [
        'timeout' => 60, // Augmenté à 60 secondes
        'verify' => false, // Disable SSL verification for local development
        'connect_timeout' => 10, // Timeout de connexion
    ],
    'max_tokens' => [
        'chat' => 500,
        'analysis' => 1500,
    ],
    'temperature' => 0.7,
    'retry' => [
        'max_attempts' => 3,
        'delay' => 1000, // 1 seconde entre les tentatives
    ],
];