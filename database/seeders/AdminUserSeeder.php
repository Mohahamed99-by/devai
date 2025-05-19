<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer le rôle admin
        $adminRole = Role::where('slug', 'admin')->first();
        
        if ($adminRole) {
            // Créer un utilisateur administrateur par défaut
            User::create([
                'name' => 'Administrateur',
                'email' => 'mohamedtolba161@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => $adminRole->id,
            ]);
        }
    }
}
