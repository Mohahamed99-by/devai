<?php

return [

    /*
    |--------------------------------------------------------------------------
    | OpenAI API Key and Organization
    |--------------------------------------------------------------------------
    |
    | Here you may specify your OpenAI API Key and organization. This will be
    | used to authenticate with the OpenAI API - you can find your API key
    | and organization on your OpenAI dashboard, at https://openai.com.
    */

    'api_key' => env('OPENAI_API_KEY'),
    'organization' => env('OPENAI_ORGANIZATION'),

    /*
    |--------------------------------------------------------------------------
    | Request Timeout
    |--------------------------------------------------------------------------
    |
    | The timeout may be used to specify the maximum number of seconds to wait
    | for a response. By default, the client will time out after 30 seconds.
    */

    'request_timeout' => env('OPENAI_REQUEST_TIMEOUT', 60),

    /*
    |--------------------------------------------------------------------------
    | Model Configuration
    |--------------------------------------------------------------------------
    |
    | Default model to use for OpenAI requests
    */

    'model' => env('OPENAI_MODEL', 'gpt-3.5-turbo'),

    /*
    |--------------------------------------------------------------------------
    | HTTP Configuration
    |--------------------------------------------------------------------------
    |
    | HTTP client configuration for OpenAI requests
    */

    'http' => [
        'timeout' => 60, // Augmenté à 60 secondes
        'verify' => false, // Disable SSL verification for local development
        'connect_timeout' => 10, // Timeout de connexion
    ],

    /*
    |--------------------------------------------------------------------------
    | Token Limits
    |--------------------------------------------------------------------------
    |
    | Maximum tokens for different types of operations
    */

    'max_tokens' => [
        'analysis' => 1500,
    ],

    /*
    |--------------------------------------------------------------------------
    | Temperature Setting
    |--------------------------------------------------------------------------
    |
    | Controls randomness in the output (0.0 to 2.0)
    */

    'temperature' => 0.7,

    /*
    |--------------------------------------------------------------------------
    | Retry Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for retry attempts on failed requests
    */

    'retry' => [
        'max_attempts' => 3,
        'delay' => 1000, // 1 seconde entre les tentatives
    ],
];
