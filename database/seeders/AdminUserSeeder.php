<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Administrateur',
            'email' => 'studiowebspark@gmail.com',
            'password' => Hash::make('26Te006mk7l@'),
            'is_admin' => 1,
            'email_verified_at' => now()
        ]);
    }
}
