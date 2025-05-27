<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ClientResponseController;
use App\Services\AdminNotificationService;
use App\Models\ClientResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class TestFormSubmissionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'form:test-submission {--user-id= : ID de l\'utilisateur pour le test}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Teste la soumission de formulaire et l\'envoi de notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Test de soumission de formulaire ===');
        $this->newLine();

        $userId = $this->option('user-id');
        
        // Si un user-id est fourni, simuler une connexion
        if ($userId) {
            $user = User::find($userId);
            if ($user) {
                Auth::login($user);
                $this->info("Utilisateur connecté: {$user->name} ({$user->email})");
            } else {
                $this->error("Utilisateur avec ID {$userId} introuvable");
                return;
            }
        } else {
            $this->info("Test en tant qu'utilisateur non-authentifié");
        }

        // Données de test pour le formulaire
        $testData = [
            'project_name' => 'Test Project - ' . now()->format('Y-m-d H:i:s'),
            'project_type' => 'web',
            'project_description' => 'Ceci est un test de soumission de formulaire pour vérifier les notifications email.',
            'target_audience' => 'Développeurs et testeurs',
            'main_features' => 'Test de notifications, Envoi d\'emails, Vérification du système',
            'technical_requirements' => 'Laravel, PHP, MySQL',
            'budget_range' => '5000-10000',
            'timeline' => '1-3 mois',
            'additional_info' => 'Test automatisé depuis la ligne de commande'
        ];

        $this->info('Données de test:');
        foreach ($testData as $key => $value) {
            $this->line("  {$key}: {$value}");
        }
        $this->newLine();

        try {
            // Créer une instance du contrôleur
            $controller = new ClientResponseController();
            
            // Créer une requête simulée
            $request = new Request($testData);
            $request->setMethod('POST');

            $this->info('Soumission du formulaire...');
            
            // Appeler la méthode store
            $response = $controller->store($request);
            
            // Vérifier la réponse
            if ($response->getStatusCode() === 200) {
                $responseData = json_decode($response->getContent(), true);
                
                if ($responseData['status'] === 'success') {
                    $this->info('✅ Formulaire soumis avec succès');
                    $this->line("ID de la réponse: {$responseData['data']['id']}");
                    
                    // Vérifier si l'email a été envoyé
                    $this->info('Vérification de l\'envoi d\'email...');
                    
                    // Attendre un peu pour que l'email soit traité
                    sleep(2);
                    
                    $this->info('✅ Test terminé. Vérifiez votre boîte email.');
                } else {
                    $this->error('❌ Erreur dans la réponse: ' . $responseData['message']);
                }
            } else {
                $this->error('❌ Erreur HTTP: ' . $response->getStatusCode());
            }

        } catch (Exception $e) {
            $this->error('❌ Erreur lors de la soumission: ' . $e->getMessage());
            Log::error('Test form submission failed: ' . $e->getMessage());
        }

        // Déconnecter l'utilisateur si connecté
        if (Auth::check()) {
            Auth::logout();
        }

        $this->newLine();
        $this->info('=== Fin du test ===');
    }
}
