<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Services\AdminNotificationService;
use App\Services\AwsEmailService;
use App\Services\MailService;
use Exception;

class TestEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test {--service=all : Service à tester (all, laravel, aws, mail, admin)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test l\'envoi d\'emails avec différents services';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $service = $this->option('service');

        $this->info('=== Test d\'envoi d\'email DevsAI ===');
        $this->newLine();

        // Afficher la configuration
        $this->displayConfiguration();

        // Tester selon le service demandé
        switch ($service) {
            case 'laravel':
                $this->testLaravelMail();
                break;
            case 'aws':
                $this->testAwsEmailService();
                break;
            case 'mail':
                $this->testMailService();
                break;
            case 'admin':
                $this->testAdminNotificationService();
                break;
            case 'all':
            default:
                $this->testLaravelMail();
                $this->testAwsEmailService();
                $this->testMailService();
                $this->testAdminNotificationService();
                break;
        }

        $this->info('=== Fin des tests ===');
    }

    private function displayConfiguration()
    {
        $this->info('Configuration email:');
        $this->line('MAIL_MAILER: ' . env('MAIL_MAILER'));
        $this->line('MAIL_HOST: ' . env('MAIL_HOST'));
        $this->line('MAIL_PORT: ' . env('MAIL_PORT'));
        $this->line('MAIL_USERNAME: ' . env('MAIL_USERNAME'));
        $this->line('MAIL_PASSWORD: ' . (env('MAIL_PASSWORD') ? '***configuré***' : 'NON CONFIGURÉ'));
        $this->line('MAIL_ENCRYPTION: ' . env('MAIL_ENCRYPTION'));
        $this->line('MAIL_FROM_ADDRESS: ' . env('MAIL_FROM_ADDRESS'));
        $this->line('MAIL_ADMIN_EMAIL: ' . env('MAIL_ADMIN_EMAIL'));
        $this->line('MAIL_ENABLED: ' . (env('MAIL_ENABLED') ? 'true' : 'false'));
        $this->newLine();
    }

    private function testLaravelMail()
    {
        $this->info('Test avec Laravel Mail:');
        try {
            Mail::raw('Test email depuis DevsAI - Laravel Mail', function ($message) {
                $message->to(env('MAIL_ADMIN_EMAIL'))
                        ->subject('Test Email Laravel - DevsAI')
                        ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });
            $this->info('✅ Email Laravel envoyé avec succès');
        } catch (Exception $e) {
            $this->error('❌ Erreur Laravel Mail: ' . $e->getMessage());
            Log::error('Test Laravel Mail failed: ' . $e->getMessage());
        }
        $this->newLine();
    }

    private function testAwsEmailService()
    {
        $this->info('Test avec AwsEmailService:');
        try {
            $awsEmailService = app(AwsEmailService::class);
            $result = $awsEmailService->sendEmail(
                env('MAIL_ADMIN_EMAIL'),
                'Test AwsEmailService - DevsAI',
                '<h1>Test Email</h1><p>Ceci est un test depuis AwsEmailService</p>',
                env('MAIL_FROM_ADDRESS'),
                env('MAIL_FROM_NAME'),
                env('MAIL_FROM_ADDRESS'),
                env('MAIL_FROM_NAME')
            );

            if ($result) {
                $this->info('✅ AwsEmailService: Email envoyé avec succès');
            } else {
                $this->error('❌ AwsEmailService: Échec de l\'envoi');
            }
        } catch (Exception $e) {
            $this->error('❌ Erreur AwsEmailService: ' . $e->getMessage());
            Log::error('Test AwsEmailService failed: ' . $e->getMessage());
        }
        $this->newLine();
    }

    private function testMailService()
    {
        $this->info('Test avec MailService:');
        try {
            $mailService = app(MailService::class);
            $result = $mailService->sendEmail(
                env('MAIL_ADMIN_EMAIL'),
                'Test MailService - DevsAI',
                '<h1>Test Email</h1><p>Ceci est un test depuis MailService</p>',
                env('MAIL_FROM_ADDRESS'),
                env('MAIL_FROM_NAME'),
                env('MAIL_FROM_ADDRESS'),
                env('MAIL_FROM_NAME')
            );

            if ($result) {
                $this->info('✅ MailService: Email envoyé avec succès');
            } else {
                $this->error('❌ MailService: Échec de l\'envoi');
            }
        } catch (Exception $e) {
            $this->error('❌ Erreur MailService: ' . $e->getMessage());
            Log::error('Test MailService failed: ' . $e->getMessage());
        }
        $this->newLine();
    }

    private function testAdminNotificationService()
    {
        $this->info('Test avec AdminNotificationService:');
        try {
            // Créer une vraie réponse client pour le test
            $clientResponse = new \App\Models\ClientResponse();
            $clientResponse->id = 999;
            $clientResponse->project_name = 'Test Project';
            $clientResponse->project_type = 'web';
            $clientResponse->user_id = null;
            $clientResponse->created_at = now();
            $clientResponse->exists = true; // Simuler que l'objet existe en DB

            $adminService = app(AdminNotificationService::class);
            $result = $adminService->sendUnifiedNotification($clientResponse, 'Test User');

            if ($result) {
                $this->info('✅ AdminNotificationService: Email envoyé avec succès');
            } else {
                $this->error('❌ AdminNotificationService: Échec de l\'envoi');
            }
        } catch (Exception $e) {
            $this->error('❌ Erreur AdminNotificationService: ' . $e->getMessage());
            Log::error('Test AdminNotificationService failed: ' . $e->getMessage());
        }
        $this->newLine();
    }
}
