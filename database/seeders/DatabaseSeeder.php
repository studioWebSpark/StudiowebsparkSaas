<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Création de l'administrateur
        User::create([
            'name' => 'Administrateur',
            'email' => 'studiowebspark@gmail.com',
            'password' => Hash::make('rrr'),
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        // Création de l'utilisateur test si nécessaire
        User::factory()->withPersonalTeam()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => false,
        ]);
    }
}
