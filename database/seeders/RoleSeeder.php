<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Rôle Administrateur
        Role::create([
            'name' => 'Administrateur',
            'slug' => 'admin',
            'description' => 'Administrateur du système avec tous les privilèges',
            'permissions' => [
                'view_technical_sheets',
                'create_technical_sheets',
                'edit_technical_sheets',
                'delete_technical_sheets',
                'validate_technical_sheets',
                'export_technical_sheets',
                'manage_users',
            ],
        ]);

        // Rôle Client
        Role::create([
            'name' => 'Client',
            'slug' => 'client',
            'description' => 'Utilisateur standard qui peut créer et consulter ses propres fiches techniques',
            'permissions' => [
                'view_own_technical_sheets',
                'create_technical_sheets',
                'edit_own_technical_sheets',
                'delete_own_technical_sheets',
                'export_own_technical_sheets',
            ],
        ]);
    }
}
