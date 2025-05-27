<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Exception;

class CleanDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:clean {--force : Force the operation without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Nettoie la base de données en supprimant les tables orphelines et les contraintes problématiques';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->option('force')) {
            if (!$this->confirm('Cette opération va nettoyer la base de données. Voulez-vous continuer ?')) {
                $this->info('Opération annulée.');
                return;
            }
        }

        $this->info('=== Nettoyage de la base de données ===');
        $this->newLine();

        try {
            // Désactiver les vérifications de clés étrangères
            $this->info('1. Désactivation des vérifications de clés étrangères...');
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            // Lister toutes les tables
            $tables = DB::select('SHOW TABLES');
            $databaseName = DB::getDatabaseName();
            $tableColumn = "Tables_in_{$databaseName}";

            $this->info('2. Tables trouvées dans la base de données :');
            foreach ($tables as $table) {
                $tableName = $table->$tableColumn;
                $this->line("   - {$tableName}");
            }
            $this->newLine();

            // Supprimer les tables de chat si elles existent
            $chatTables = ['chat_messages', 'chat_conversations'];
            $this->info('3. Suppression des tables de chat orphelines...');
            
            foreach ($chatTables as $chatTable) {
                if (Schema::hasTable($chatTable)) {
                    $this->line("   Suppression de la table : {$chatTable}");
                    Schema::dropIfExists($chatTable);
                    $this->info("   ✅ Table {$chatTable} supprimée");
                } else {
                    $this->line("   ⚠️  Table {$chatTable} n'existe pas");
                }
            }

            // Réactiver les vérifications de clés étrangères
            $this->info('4. Réactivation des vérifications de clés étrangères...');
            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            // Vérifier les tables restantes
            $this->info('5. Vérification des tables restantes...');
            $remainingTables = DB::select('SHOW TABLES');
            foreach ($remainingTables as $table) {
                $tableName = $table->$tableColumn;
                $this->line("   ✅ {$tableName}");
            }

            $this->newLine();
            $this->info('✅ Nettoyage de la base de données terminé avec succès !');
            $this->newLine();
            $this->info('Vous pouvez maintenant exécuter : php artisan migrate:fresh --seed');

        } catch (Exception $e) {
            $this->error('❌ Erreur lors du nettoyage : ' . $e->getMessage());
            
            // Réactiver les vérifications en cas d'erreur
            try {
                DB::statement('SET FOREIGN_KEY_CHECKS=1');
            } catch (Exception $e2) {
                $this->error('❌ Erreur lors de la réactivation des clés étrangères : ' . $e2->getMessage());
            }
            
            return 1;
        }

        return 0;
    }
}
