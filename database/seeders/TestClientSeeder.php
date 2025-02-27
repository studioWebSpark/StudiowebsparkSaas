<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TestClientSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Client Test',
            'email' => 'kircilm@gmail.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'is_admin' => false
        ]);
    }
}
