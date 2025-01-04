<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrateur',
            'email' => 'studiowebspark@gmail.com',
            'password' => Hash::make('26Te006mk7l@'),
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);
    }
}
