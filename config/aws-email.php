<?php

return [

    /*
    |--------------------------------------------------------------------------
    | AWS Email Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration spécifique pour l'envoi d'emails sur AWS
    |
    */

    'enabled' => env('AWS_EMAIL_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | AWS SES Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration pour Amazon Simple Email Service
    |
    */
    'ses' => [
        'enabled' => env('AWS_SES_ENABLED', false),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
        'access_key' => env('AWS_ACCESS_KEY_ID'),
        'secret_key' => env('AWS_SECRET_ACCESS_KEY'),
        'configuration_set' => env('AWS_SES_CONFIGURATION_SET'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Email Services Priority
    |--------------------------------------------------------------------------
    |
    | Ordre de priorité des services d'email
    | 1 = Priorité la plus élevée
    |
    */
    'services_priority' => [
        'aws_ses' => 1,
        'smtp' => 2,
        'mailgun' => 3,
        'sendgrid' => 4,
    ],

    /*
    |--------------------------------------------------------------------------
    | Retry Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration des tentatives de retry
    |
    */
    'retry' => [
        'enabled' => true,
        'max_attempts' => 3,
        'delay_seconds' => 5,
        'exponential_backoff' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration du logging pour les emails AWS
    |
    */
    'logging' => [
        'enabled' => true,
        'level' => env('AWS_EMAIL_LOG_LEVEL', 'info'),
        'include_content' => env('AWS_EMAIL_LOG_CONTENT', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Template Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration des templates d'email pour AWS
    |
    */
    'templates' => [
        'unified_notification' => 'emails.unified-notification',
        'test_email' => 'emails.test',
    ],

    /*
    |--------------------------------------------------------------------------
    | Rate Limiting
    |--------------------------------------------------------------------------
    |
    | Configuration de la limitation du taux d'envoi
    |
    */
    'rate_limiting' => [
        'enabled' => env('AWS_EMAIL_RATE_LIMITING', false),
        'max_emails_per_minute' => env('AWS_EMAIL_MAX_PER_MINUTE', 60),
        'max_emails_per_hour' => env('AWS_EMAIL_MAX_PER_HOUR', 1000),
    ],

    /*
    |--------------------------------------------------------------------------
    | Monitoring Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration du monitoring des emails
    |
    */
    'monitoring' => [
        'enabled' => true,
        'track_opens' => env('AWS_EMAIL_TRACK_OPENS', false),
        'track_clicks' => env('AWS_EMAIL_TRACK_CLICKS', false),
        'bounce_handling' => env('AWS_EMAIL_BOUNCE_HANDLING', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Environment Specific Settings
    |--------------------------------------------------------------------------
    |
    | Paramètres spécifiques à l'environnement
    |
    */
    'environment' => [
        'production' => [
            'verify_ssl' => true,
            'timeout' => 30,
            'debug' => false,
        ],
        'staging' => [
            'verify_ssl' => true,
            'timeout' => 30,
            'debug' => true,
        ],
        'local' => [
            'verify_ssl' => false,
            'timeout' => 10,
            'debug' => true,
        ],
    ],

];
