<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Exception;

class FixUserRolesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:fix-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Corrige les problèmes de rôles des utilisateurs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Correction des rôles utilisateurs ===');
        $this->newLine();

        try {
            // Vérifier si la table roles existe
            if (!DB::getSchemaBuilder()->hasTable('roles')) {
                $this->error('❌ La table "roles" n\'existe pas. Exécutez d\'abord les migrations.');
                return 1;
            }

            // Créer les rôles par défaut s'ils n'existent pas
            $this->info('1. Création des rôles par défaut...');
            
            $adminRole = Role::firstOrCreate([
                'name' => 'admin'
            ], [
                'description' => 'Administrateur du système'
            ]);
            $this->line("   ✅ Rôle admin : ID {$adminRole->id}");

            $clientRole = Role::firstOrCreate([
                'name' => 'client'
            ], [
                'description' => 'Client utilisateur'
            ]);
            $this->line("   ✅ Rôle client : ID {$clientRole->id}");

            // Vérifier et corriger les utilisateurs sans rôle
            $this->info('2. Vérification des utilisateurs...');
            
            $usersWithoutRole = User::whereNull('role_id')->get();
            $this->line("   Utilisateurs sans rôle : {$usersWithoutRole->count()}");

            if ($usersWithoutRole->count() > 0) {
                $this->info('3. Attribution des rôles par défaut...');
                
                foreach ($usersWithoutRole as $user) {
                    // Attribuer le rôle client par défaut
                    $user->role_id = $clientRole->id;
                    $user->save();
                    
                    $this->line("   ✅ Utilisateur {$user->name} ({$user->email}) -> rôle client");
                }
            }

            // Créer un utilisateur admin par défaut s'il n'existe pas
            $this->info('4. Vérification de l\'administrateur...');
            
            $adminUser = User::where('role_id', $adminRole->id)->first();
            if (!$adminUser) {
                $this->info('   Aucun administrateur trouvé. Création d\'un compte admin...');
                
                $adminUser = User::create([
                    'name' => 'Administrateur',
                    'email' => 'admin@devsai.com',
                    'password' => bcrypt('admin123'),
                    'role_id' => $adminRole->id,
                    'email_verified_at' => now()
                ]);
                
                $this->info("   ✅ Administrateur créé : {$adminUser->email} (mot de passe: admin123)");
            } else {
                $this->line("   ✅ Administrateur existant : {$adminUser->email}");
            }

            // Statistiques finales
            $this->info('5. Statistiques finales...');
            $totalUsers = User::count();
            $adminUsers = User::where('role_id', $adminRole->id)->count();
            $clientUsers = User::where('role_id', $clientRole->id)->count();
            
            $this->line("   Total utilisateurs : {$totalUsers}");
            $this->line("   Administrateurs : {$adminUsers}");
            $this->line("   Clients : {$clientUsers}");

            $this->newLine();
            $this->info('✅ Correction des rôles terminée avec succès !');

        } catch (Exception $e) {
            $this->error('❌ Erreur lors de la correction des rôles : ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
