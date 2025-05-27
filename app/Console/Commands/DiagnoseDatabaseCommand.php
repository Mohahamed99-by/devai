<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Exception;

class DiagnoseDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:diagnose {--fix : Tenter de corriger automatiquement les problèmes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Diagnostique les problèmes de base de données et propose des solutions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Diagnostic de la base de données ===');
        $this->newLine();

        try {
            // Test de connexion
            $this->info('1. Test de connexion à la base de données...');
            $dbName = DB::connection()->getDatabaseName();
            $this->info("   ✅ Connexion réussie à la base : {$dbName}");

            // Lister les tables existantes
            $this->info('2. Tables existantes dans la base de données :');
            $tables = DB::select('SHOW TABLES');
            $tableColumn = "Tables_in_{$dbName}";
            
            $existingTables = [];
            if (empty($tables)) {
                $this->warn('   ⚠️  Aucune table trouvée dans la base de données');
            } else {
                foreach ($tables as $table) {
                    $tableName = $table->$tableColumn;
                    $existingTables[] = $tableName;
                    $this->line("   - {$tableName}");
                }
            }

            // Vérifier les tables requises
            $this->info('3. Vérification des tables requises :');
            $requiredTables = [
                'users',
                'roles', 
                'client_responses',
                'notifications',
                'migrations'
            ];

            $missingTables = [];
            foreach ($requiredTables as $table) {
                if (in_array($table, $existingTables)) {
                    $this->info("   ✅ {$table}");
                } else {
                    $this->error("   ❌ {$table} - MANQUANTE");
                    $missingTables[] = $table;
                }
            }

            // Vérifier les migrations
            $this->info('4. État des migrations :');
            try {
                if (in_array('migrations', $existingTables)) {
                    $migrations = DB::table('migrations')->get();
                    $this->info("   Migrations exécutées : {$migrations->count()}");
                    
                    if ($migrations->count() === 0) {
                        $this->warn('   ⚠️  Aucune migration exécutée');
                    }
                } else {
                    $this->error('   ❌ Table migrations manquante');
                }
            } catch (Exception $e) {
                $this->error('   ❌ Erreur lors de la vérification des migrations : ' . $e->getMessage());
            }

            // Proposer des solutions
            $this->newLine();
            $this->info('5. Solutions recommandées :');
            
            if (!empty($missingTables)) {
                $this->warn('   Des tables importantes sont manquantes.');
                
                if ($this->option('fix')) {
                    $this->info('   🔧 Tentative de correction automatique...');
                    $this->attemptFix($existingTables, $missingTables);
                } else {
                    $this->info('   Pour corriger automatiquement : php artisan db:diagnose --fix');
                    $this->info('   Ou manuellement :');
                    $this->line('     - php artisan migrate:install (si table migrations manquante)');
                    $this->line('     - php artisan migrate');
                    $this->line('     - php artisan db:seed (optionnel)');
                }
            } else {
                $this->info('   ✅ Toutes les tables requises sont présentes');
            }

        } catch (Exception $e) {
            $this->error('❌ Erreur lors du diagnostic : ' . $e->getMessage());
            $this->newLine();
            $this->info('Vérifiez votre configuration .env :');
            $this->line('  DB_CONNECTION=' . env('DB_CONNECTION'));
            $this->line('  DB_HOST=' . env('DB_HOST'));
            $this->line('  DB_DATABASE=' . env('DB_DATABASE'));
            $this->line('  DB_USERNAME=' . env('DB_USERNAME'));
            return 1;
        }

        return 0;
    }

    private function attemptFix($existingTables, $missingTables)
    {
        try {
            // Installer la table migrations si elle n'existe pas
            if (!in_array('migrations', $existingTables)) {
                $this->info('   📦 Installation de la table migrations...');
                Artisan::call('migrate:install');
                $this->info('   ✅ Table migrations installée');
            }

            // Exécuter les migrations
            $this->info('   🚀 Exécution des migrations...');
            Artisan::call('migrate', ['--force' => true]);
            $this->info('   ✅ Migrations exécutées');

            // Vérifier le résultat
            $this->info('   🔍 Vérification post-correction...');
            $tables = DB::select('SHOW TABLES');
            $dbName = DB::connection()->getDatabaseName();
            $tableColumn = "Tables_in_{$dbName}";
            
            $newExistingTables = [];
            foreach ($tables as $table) {
                $newExistingTables[] = $table->$tableColumn;
            }

            $stillMissing = array_diff($missingTables, $newExistingTables);
            if (empty($stillMissing)) {
                $this->info('   ✅ Toutes les tables ont été créées avec succès !');
            } else {
                $this->warn('   ⚠️  Tables encore manquantes : ' . implode(', ', $stillMissing));
            }

        } catch (Exception $e) {
            $this->error('   ❌ Erreur lors de la correction : ' . $e->getMessage());
        }
    }
}
