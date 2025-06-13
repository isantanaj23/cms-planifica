<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario administrador si no existe
        if (!User::where('email', 'admin@planificamas.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@planificamas.com',
                'password' => bcrypt('admin123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]);
        }

        // Crear usuario de prueba adicional
        if (!User::where('email', 'demo@planificamas.com')->exists()) {
            User::create([
                'name' => 'Demo User',
                'email' => 'demo@planificamas.com',
                'password' => bcrypt('demo123'),
                'is_admin' => false,
                'email_verified_at' => now(),
            ]);
        }
    }
}