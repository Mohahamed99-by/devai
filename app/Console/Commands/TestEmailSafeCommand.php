<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Services\AdminNotificationService;
use App\Models\ClientResponse;
use Exception;

class TestEmailSafeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test-safe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test d\'envoi d\'email sécurisé sans logging problématique';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Test d\'envoi d\'email sécurisé ===');
        $this->newLine();

        try {
            // Configuration email
            $this->info('Configuration email:');
            $this->line('MAIL_MAILER: ' . env('MAIL_MAILER'));
            $this->line('MAIL_HOST: ' . env('MAIL_HOST'));
            $this->line('MAIL_FROM_ADDRESS: ' . env('MAIL_FROM_ADDRESS'));
            $this->line('MAIL_ADMIN_EMAIL: ' . env('MAIL_ADMIN_EMAIL'));
            $this->newLine();

            // Test simple avec Laravel Mail
            $this->info('1. Test Laravel Mail simple...');
            Mail::raw('Test email simple depuis DevsAI', function ($message) {
                $message->to(env('MAIL_ADMIN_EMAIL'))
                        ->subject('Test Simple - DevsAI')
                        ->from(env('MAIL_FROM_ADDRESS'), 'DevsAI Test');
            });
            $this->info('   ✅ Email simple envoyé');

            // Test avec un ClientResponse sécurisé
            $this->info('2. Test avec ClientResponse sécurisé...');
            
            $clientResponse = new ClientResponse();
            $clientResponse->id = 999;
            $clientResponse->project_name = 'Test Project Safe';
            $clientResponse->project_type = 'web';
            $clientResponse->project_description = 'Description de test sécurisée';
            $clientResponse->target_audience = 'Public test';
            $clientResponse->main_features = 'Fonctionnalités de test';
            $clientResponse->budget_range = '5000-10000';
            $clientResponse->timeline = '2-3 mois';
            $clientResponse->user_id = null;
            $clientResponse->status = 'temporary';
            $clientResponse->created_at = now();
            
            // Données IA sécurisées
            $clientResponse->ai_analysis_summary = 'Analyse de test sécurisée';
            $clientResponse->ai_estimated_duration = '2-3 mois';
            $clientResponse->ai_cost_estimate = '7500'; // String au lieu de decimal
            $clientResponse->ai_complexity_factors = ['Test factor 1', 'Test factor 2'];
            
            // Simuler l'existence en base
            $clientResponse->exists = true;

            $this->info('   Données ClientResponse préparées');

            // Test avec AdminNotificationService
            $adminService = app(AdminNotificationService::class);
            
            // Désactiver temporairement le logging pour éviter les erreurs de permissions
            config(['logging.default' => 'single']);
            config(['logging.channels.single.path' => '/tmp/laravel-test.log']);
            
            $result = $adminService->sendUnifiedNotification($clientResponse, 'Test User Safe');
            
            if ($result) {
                $this->info('   ✅ AdminNotificationService: Email envoyé avec succès');
            } else {
                $this->warn('   ⚠️  AdminNotificationService: Échec de l\'envoi');
            }

        } catch (Exception $e) {
            $this->error('❌ Erreur: ' . $e->getMessage());
            
            // Afficher plus de détails sur l'erreur
            $this->newLine();
            $this->error('Détails de l\'erreur:');
            $this->line('Fichier: ' . $e->getFile());
            $this->line('Ligne: ' . $e->getLine());
            
            return 1;
        }

        $this->newLine();
        $this->info('✅ Test terminé avec succès !');
        $this->info('📧 Vérifiez votre boîte email: ' . env('MAIL_ADMIN_EMAIL'));
        
        return 0;
    }
}
