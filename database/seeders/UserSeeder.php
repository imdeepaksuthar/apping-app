<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 1, // Admin role
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Regular User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 2, // User role
            'email_verified_at' => now(),
        ]);
    }
}
