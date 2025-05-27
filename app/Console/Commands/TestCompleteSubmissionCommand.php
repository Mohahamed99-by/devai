<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ClientResponse;
use App\Services\AdminNotificationService;
use Illuminate\Support\Facades\Log;
use Exception;

class TestCompleteSubmissionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:complete-submission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Teste une soumission complète avec notification email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Test de soumission complète ===');
        $this->newLine();

        try {
            // Créer une nouvelle réponse client de test
            $clientResponse = new ClientResponse();
            $clientResponse->project_name = 'Projet Test - ' . now()->format('Y-m-d H:i:s');
            $clientResponse->project_type = 'web';
            $clientResponse->project_description = 'Application web moderne pour la gestion de projets avec interface utilisateur intuitive et fonctionnalités avancées de collaboration.';
            $clientResponse->target_audience = 'Équipes de développement et chefs de projet';
            $clientResponse->main_features = 'Gestion de tâches, Collaboration en temps réel, Tableaux de bord analytiques, Notifications push, API REST';
            $clientResponse->technical_requirements = 'Laravel 10, Vue.js 3, MySQL 8, Redis, Docker';
            $clientResponse->budget_range = '10000-25000';
            $clientResponse->timeline = '3-6 mois';
            $clientResponse->additional_info = 'Projet prioritaire avec besoin de démarrage rapide. Équipe expérimentée disponible.';
            $clientResponse->status = 'temporary';
            $clientResponse->user_id = null;
            
            // Simuler une analyse IA
            $clientResponse->ai_analysis_summary = 'Projet web complexe nécessitant une architecture moderne. Recommandation d\'utiliser une approche microservices avec API REST.';
            $clientResponse->ai_estimated_duration = '4-5 mois';
            $clientResponse->ai_cost_estimate = '15000-20000 EUR';
            $clientResponse->ai_complexity_factors = [
                'Interface utilisateur complexe',
                'Intégration temps réel',
                'Gestion de permissions avancée',
                'Scalabilité requise'
            ];
            $clientResponse->ai_suggested_technologies = [
                'Laravel 10',
                'Vue.js 3',
                'WebSockets',
                'Redis',
                'Docker'
            ];
            $clientResponse->ai_risk_factors = [
                'Complexité de l\'interface temps réel',
                'Intégration avec systèmes existants'
            ];
            
            $clientResponse->created_at = now();
            $clientResponse->updated_at = now();

            $this->info('Données de test créées:');
            $this->line("  Nom du projet: {$clientResponse->project_name}");
            $this->line("  Type: {$clientResponse->project_type}");
            $this->line("  Budget: {$clientResponse->budget_range}");
            $this->line("  Délai: {$clientResponse->timeline}");
            $this->newLine();

            // Envoyer la notification
            $this->info('Envoi de la notification email...');
            
            $adminService = app(AdminNotificationService::class);
            $result = $adminService->sendUnifiedNotification($clientResponse, 'Utilisateur Test');
            
            if ($result) {
                $this->info('✅ Notification envoyée avec succès !');
                $this->newLine();
                $this->info('📧 Vérifiez votre boîte email: mohamedtolba161@gmail.com');
                $this->info('📋 L\'email contient maintenant:');
                $this->line('  • Détails complets de l\'utilisateur');
                $this->line('  • Informations détaillées du projet');
                $this->line('  • Analyse IA complète');
                $this->line('  • Boutons d\'action directs');
                $this->line('  • Design amélioré avec émojis');
            } else {
                $this->error('❌ Échec de l\'envoi de la notification');
            }

        } catch (Exception $e) {
            $this->error('❌ Erreur: ' . $e->getMessage());
            Log::error('Test complete submission failed: ' . $e->getMessage());
        }

        $this->newLine();
        $this->info('=== Fin du test ===');
    }
}
