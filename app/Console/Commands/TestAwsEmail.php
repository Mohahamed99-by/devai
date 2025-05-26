<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\AwsEmailService;
use App\Services\AdminNotificationService;
use App\Models\ClientResponse;
use Illuminate\Support\Facades\Log;

class TestAwsEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test-aws {--service=all : Service à tester (aws|smtp|mailgun|all)} {--to= : Email de destination}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tester l\'envoi d\'emails sur AWS avec différents services';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Test des services email AWS');
        $this->newLine();

        $service = $this->option('service');
        $to = $this->option('to') ?: env('MAIL_ADMIN_EMAIL');

        if (!$to) {
            $this->error('❌ Aucune adresse email de destination configurée');
            return 1;
        }

        // 1. Afficher la configuration
        $this->displayConfiguration();

        // 2. Tester les services selon l'option
        switch ($service) {
            case 'aws':
                $this->testAwsService($to);
                break;
            case 'smtp':
                $this->testSmtpService($to);
                break;
            case 'mailgun':
                $this->testMailgunService($to);
                break;
            case 'all':
            default:
                $this->testAllServices($to);
                break;
        }

        $this->newLine();
        $this->info('✅ Tests terminés');
        return 0;
    }

    /**
     * Afficher la configuration actuelle
     */
    protected function displayConfiguration()
    {
        $this->info('📋 Configuration actuelle:');
        
        $config = [
            'Environment' => app()->environment(),
            'MAIL_ENABLED' => env('MAIL_ENABLED') ? '✅' : '❌',
            'AWS_ACCESS_KEY_ID' => env('AWS_ACCESS_KEY_ID') ? '✅ Configuré' : '❌ Non configuré',
            'AWS_SECRET_ACCESS_KEY' => env('AWS_SECRET_ACCESS_KEY') ? '✅ Configuré' : '❌ Non configuré',
            'AWS_DEFAULT_REGION' => env('AWS_DEFAULT_REGION', 'Non défini'),
            'MAIL_HOST' => env('MAIL_HOST', 'Non défini'),
            'MAILGUN_DOMAIN' => env('MAILGUN_DOMAIN') ? '✅ Configuré' : '❌ Non configuré',
        ];

        foreach ($config as $key => $value) {
            $this->line("   - {$key}: {$value}");
        }
        $this->newLine();
    }

    /**
     * Tester tous les services
     */
    protected function testAllServices(string $to)
    {
        $this->info('🔄 Test de tous les services...');
        
        // Test du service AWS Email
        $this->testAwsEmailService($to);
        
        // Test du service AdminNotificationService
        $this->testAdminNotificationService($to);
        
        // Test des services individuels
        $awsEmailService = app(AwsEmailService::class);
        $servicesStatus = $awsEmailService->getEmailServicesStatus();
        
        foreach ($servicesStatus as $serviceName => $status) {
            if ($status['configured']) {
                $this->testIndividualService($serviceName, $to);
            } else {
                $this->warn("⚠️  Service {$serviceName}: Non configuré");
            }
        }
    }

    /**
     * Tester le service AWS Email
     */
    protected function testAwsEmailService(string $to)
    {
        $this->info('🧪 Test du service AwsEmailService...');
        
        try {
            $awsEmailService = app(AwsEmailService::class);
            
            $result = $awsEmailService->sendEmail(
                $to,
                'Test AWS Email Service - ' . now()->format('Y-m-d H:i:s'),
                '<h1>Test AWS Email Service</h1><p>Ce test vérifie le fonctionnement du service AwsEmailService.</p><p>Timestamp: ' . now() . '</p>',
                env('MAIL_FROM_ADDRESS'),
                'Test AWS DevsAI'
            );
            
            if ($result) {
                $this->info('   ✅ AwsEmailService: SUCCÈS');
            } else {
                $this->error('   ❌ AwsEmailService: ÉCHEC');
            }
        } catch (\Exception $e) {
            $this->error('   ❌ AwsEmailService: ERREUR - ' . $e->getMessage());
        }
    }

    /**
     * Tester le service AdminNotificationService
     */
    protected function testAdminNotificationService(string $to)
    {
        $this->info('🧪 Test du service AdminNotificationService...');
        
        try {
            // Créer une fausse réponse client
            $fakeResponse = new ClientResponse();
            $fakeResponse->id = 999;
            $fakeResponse->project_type = 'web';
            $fakeResponse->project_description = 'Test AWS AdminNotificationService';
            $fakeResponse->similar_applications = 'Test app';
            $fakeResponse->target_audience = ['clients'];
            $fakeResponse->key_features = ['Test feature'];
            $fakeResponse->budget_range = '10000DH - 20000DH';
            $fakeResponse->timeline = '1-3 mois';
            $fakeResponse->technical_requirements = ['responsive'];
            $fakeResponse->needs_maintenance = true;
            $fakeResponse->created_at = now();
            
            $adminService = app(AdminNotificationService::class);
            $result = $adminService->sendUnifiedNotification($fakeResponse, 'Test User AWS Console');
            
            if ($result) {
                $this->info('   ✅ AdminNotificationService: SUCCÈS');
            } else {
                $this->error('   ❌ AdminNotificationService: ÉCHEC');
            }
        } catch (\Exception $e) {
            $this->error('   ❌ AdminNotificationService: ERREUR - ' . $e->getMessage());
        }
    }

    /**
     * Tester un service individuel
     */
    protected function testIndividualService(string $serviceName, string $to)
    {
        $this->info("🧪 Test du service {$serviceName}...");
        
        // Cette méthode pourrait être étendue pour tester chaque service individuellement
        $this->line("   ℹ️  Test individuel de {$serviceName} non implémenté");
    }

    /**
     * Tester spécifiquement AWS SES
     */
    protected function testAwsService(string $to)
    {
        $this->info('🧪 Test spécifique AWS SES...');
        
        if (!env('AWS_ACCESS_KEY_ID') || !env('AWS_SECRET_ACCESS_KEY')) {
            $this->error('❌ Credentials AWS non configurés');
            return;
        }
        
        $this->testAwsEmailService($to);
    }

    /**
     * Tester spécifiquement SMTP
     */
    protected function testSmtpService(string $to)
    {
        $this->info('🧪 Test spécifique SMTP...');
        
        if (!env('MAIL_USERNAME') || !env('MAIL_PASSWORD')) {
            $this->error('❌ Configuration SMTP incomplète');
            return;
        }
        
        // Test SMTP via AwsEmailService
        $this->testAwsEmailService($to);
    }

    /**
     * Tester spécifiquement Mailgun
     */
    protected function testMailgunService(string $to)
    {
        $this->info('🧪 Test spécifique Mailgun...');
        
        if (!env('MAILGUN_SECRET') || !env('MAILGUN_DOMAIN')) {
            $this->error('❌ Configuration Mailgun incomplète');
            return;
        }
        
        // Test Mailgun via AwsEmailService
        $this->testAwsEmailService($to);
    }
}
