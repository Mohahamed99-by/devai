<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TestEmailConfigCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test-config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Teste la configuration email de base';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔧 Test de Configuration Email - DevsAI');
        $this->newLine();

        try {
            // Vérifier les variables d'environnement
            $this->info('1. Vérification des variables d\'environnement...');
            
            $configs = [
                'MAIL_MAILER' => env('MAIL_MAILER'),
                'MAIL_HOST' => env('MAIL_HOST'),
                'MAIL_PORT' => env('MAIL_PORT'),
                'MAIL_USERNAME' => env('MAIL_USERNAME'),
                'MAIL_PASSWORD' => env('MAIL_PASSWORD') ? '***DÉFINI***' : null,
                'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
                'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
                'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),
                'MAIL_ADMIN_EMAIL' => env('MAIL_ADMIN_EMAIL'),
            ];

            $missingConfigs = [];
            foreach ($configs as $key => $value) {
                if (empty($value)) {
                    $missingConfigs[] = $key;
                    $this->line("❌ {$key}: NON DÉFINI");
                } else {
                    $this->line("✅ {$key}: {$value}");
                }
            }

            if (!empty($missingConfigs)) {
                $this->newLine();
                $this->error('Configuration incomplète. Variables manquantes:');
                foreach ($missingConfigs as $config) {
                    $this->line("  - {$config}");
                }
                return 1;
            }

            $this->newLine();
            $this->info('2. Test de connexion SMTP...');

            // Test simple d'envoi d'email
            $adminEmail = env('MAIL_ADMIN_EMAIL');
            
            Mail::raw('Test de configuration email DevsAI - ' . now()->format('d/m/Y H:i:s'), function ($message) use ($adminEmail) {
                $message->to($adminEmail)
                        ->subject('🧪 Test Configuration Email DevsAI')
                        ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });

            $this->info('✅ Email de test envoyé avec succès !');
            $this->line("📧 Destinataire: {$adminEmail}");
            $this->line("📤 Expéditeur: " . env('MAIL_FROM_ADDRESS'));

        } catch (\Exception $e) {
            $this->error('❌ Erreur lors du test: ' . $e->getMessage());
            
            // Diagnostics supplémentaires
            $this->newLine();
            $this->info('🔍 Diagnostics:');
            
            if (str_contains($e->getMessage(), 'Connection refused')) {
                $this->line('  - Vérifiez que le serveur SMTP est accessible');
                $this->line('  - Vérifiez l\'adresse et le port SMTP');
            }
            
            if (str_contains($e->getMessage(), 'Authentication failed')) {
                $this->line('  - Vérifiez les identifiants SMTP');
                $this->line('  - Vérifiez que l\'authentification 2FA est configurée si nécessaire');
            }
            
            if (str_contains($e->getMessage(), 'SSL')) {
                $this->line('  - Vérifiez la configuration SSL/TLS');
                $this->line('  - Essayez MAIL_ENCRYPTION=tls ou MAIL_ENCRYPTION=ssl');
            }

            Log::error('Email configuration test failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return 1;
        }

        $this->newLine();
        $this->info('🏁 Test de configuration terminé avec succès');
        return 0;
    }
}
