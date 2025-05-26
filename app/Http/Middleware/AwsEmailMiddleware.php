<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AwsEmailMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si nous sommes dans un environnement AWS
        $isAwsEnvironment = $this->isAwsEnvironment();
        
        if ($isAwsEnvironment) {
            // Configurer les paramètres spécifiques à AWS
            $this->configureAwsEmailSettings();
            
            Log::info('AWS Email Middleware - Configuration AWS appliquée', [
                'environment' => app()->environment(),
                'request_path' => $request->path(),
                'timestamp' => now()->toISOString()
            ]);
        }

        $response = $next($request);

        // Log des métriques après la requête si c'est lié aux emails
        if ($this->isEmailRelatedRequest($request)) {
            $this->logEmailMetrics($request, $response);
        }

        return $response;
    }

    /**
     * Vérifier si nous sommes dans un environnement AWS
     */
    protected function isAwsEnvironment(): bool
    {
        // Vérifier les variables d'environnement AWS
        $hasAwsCredentials = !empty(env('AWS_ACCESS_KEY_ID')) && !empty(env('AWS_SECRET_ACCESS_KEY'));
        
        // Vérifier si nous sommes sur une instance EC2
        $isEc2Instance = $this->isEc2Instance();
        
        // Vérifier l'environnement de production
        $isProduction = app()->environment('production');
        
        return $hasAwsCredentials || $isEc2Instance || $isProduction;
    }

    /**
     * Vérifier si nous sommes sur une instance EC2
     */
    protected function isEc2Instance(): bool
    {
        try {
            // Essayer d'accéder aux métadonnées EC2
            $context = stream_context_create([
                'http' => [
                    'timeout' => 2,
                    'method' => 'GET'
                ]
            ]);
            
            $metadata = @file_get_contents('http://169.254.169.254/latest/meta-data/instance-id', false, $context);
            return !empty($metadata);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Configurer les paramètres spécifiques à AWS
     */
    protected function configureAwsEmailSettings(): void
    {
        // Configurer les timeouts pour AWS
        config(['mail.timeout' => 30]);
        
        // Configurer les paramètres de retry
        config(['mail.retry_attempts' => 3]);
        
        // Configurer le logging
        config(['logging.channels.mail' => [
            'driver' => 'daily',
            'path' => storage_path('logs/aws-email.log'),
            'level' => 'info',
            'days' => 14,
        ]]);

        // Optimiser pour AWS SES si disponible
        if (!empty(env('AWS_ACCESS_KEY_ID'))) {
            config(['mail.default' => 'ses']);
            config(['services.ses.key' => env('AWS_ACCESS_KEY_ID')]);
            config(['services.ses.secret' => env('AWS_SECRET_ACCESS_KEY')]);
            config(['services.ses.region' => env('AWS_DEFAULT_REGION', 'us-east-1')]);
        }
    }

    /**
     * Vérifier si la requête est liée aux emails
     */
    protected function isEmailRelatedRequest(Request $request): bool
    {
        $emailPaths = [
            'test-mail',
            'test-unified-notification',
            'test-aws-email',
            'client-response'
        ];

        foreach ($emailPaths as $path) {
            if (str_contains($request->path(), $path)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Logger les métriques d'email
     */
    protected function logEmailMetrics(Request $request, Response $response): void
    {
        $metrics = [
            'request_path' => $request->path(),
            'response_status' => $response->getStatusCode(),
            'execution_time' => microtime(true) - LARAVEL_START,
            'memory_usage' => memory_get_peak_usage(true),
            'environment' => app()->environment(),
            'timestamp' => now()->toISOString()
        ];

        // Logger dans un fichier spécifique pour les métriques email
        Log::channel('mail')->info('Email Request Metrics', $metrics);
    }
}
