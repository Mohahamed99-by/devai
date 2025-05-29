<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\AdminNotificationService;
use App\Models\ClientResponse;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class TestEmailNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test-notification {--user-id= : ID de l\'utilisateur pour le test}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Teste l\'envoi d\'email de notification admin avec des données réelles ou de test';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧪 Test de notification email admin - DevsAI');
        $this->newLine();

        try {
            // Vérifier la configuration
            $this->info('1. Vérification de la configuration...');
            $adminEmail = env('MAIL_ADMIN_EMAIL');
            $fromEmail = env('MAIL_FROM_ADDRESS');
            
            if (empty($adminEmail) || empty($fromEmail)) {
                $this->error('❌ Configuration email manquante');
                $this->line('MAIL_ADMIN_EMAIL: ' . ($adminEmail ?: 'NON DÉFINI'));
                $this->line('MAIL_FROM_ADDRESS: ' . ($fromEmail ?: 'NON DÉFINI'));
                return 1;
            }
            
            $this->info('✅ Configuration OK');
            $this->line('Admin Email: ' . $adminEmail);
            $this->line('From Email: ' . $fromEmail);
            $this->newLine();

            // Créer ou récupérer un ClientResponse de test
            $this->info('2. Préparation des données de test...');
            
            $userId = $this->option('user-id');
            $user = null;
            
            if ($userId) {
                $user = User::find($userId);
                if (!$user) {
                    $this->error("❌ Utilisateur avec ID {$userId} non trouvé");
                    return 1;
                }
                $this->info("✅ Utilisateur trouvé: {$user->name} ({$user->email})");
            } else {
                $this->info('ℹ️ Aucun utilisateur spécifié, création de données de test');
            }

            // Créer un ClientResponse de test
            $clientResponse = new ClientResponse([
                'id' => 999999,
                'project_name' => 'Projet de Test - Notification Email',
                'project_type' => 'web',
                'project_description' => 'Ceci est un projet de test pour vérifier le système de notification email admin. Il contient toutes les informations nécessaires pour tester le template.',
                'target_audience' => ['clients', 'businesses'],
                'key_features' => ['Authentification utilisateur', 'Dashboard admin', 'Notifications email', 'Gestion des projets'],
                'budget_range' => '10000DH - 20000DH',
                'timeline' => '3-6 mois',
                'ai_analysis_summary' => 'Ce projet présente une complexité moyenne avec des fonctionnalités standard. Le développement nécessitera une équipe de 2-3 développeurs.',
                'ai_estimated_duration' => '4-5 mois',
                'ai_cost_estimate' => 15000,
                'ai_suggested_technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Tailwind CSS'],
                'ai_complexity_factors' => ['Intégration API tierce', 'Système de notifications', 'Interface admin complexe'],
                'ai_suggested_features' => [
                    ['name' => 'Tableau de bord analytique', 'priority' => 'high'],
                    ['name' => 'Système de notifications push', 'priority' => 'medium'],
                    ['name' => 'Export de données', 'priority' => 'low']
                ],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Associer l'utilisateur si fourni
            if ($user) {
                $clientResponse->user = $user;
            }

            $this->info('✅ Données de test préparées');
            $this->newLine();

            // Tester l'envoi de notification
            $this->info('3. Envoi de la notification de test...');
            
            $adminService = app(AdminNotificationService::class);
            $userName = $user ? $user->name : 'Testeur Email';
            
            $result = $adminService->sendUnifiedNotification($clientResponse, $userName);

            if ($result) {
                $this->info('✅ Email de notification envoyé avec succès !');
                $this->line("📧 Destinataire: {$adminEmail}");
                $this->line("👤 Utilisateur: {$userName}");
                $this->line("📋 Projet: {$clientResponse->project_name}");
            } else {
                $this->error('❌ Échec de l\'envoi de l\'email de notification');
                $this->line('Vérifiez les logs pour plus de détails');
            }

        } catch (\Exception $e) {
            $this->error('❌ Erreur lors du test: ' . $e->getMessage());
            Log::error('Test email notification failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return 1;
        }

        $this->newLine();
        $this->info('🏁 Test terminé');
        return 0;
    }
}
