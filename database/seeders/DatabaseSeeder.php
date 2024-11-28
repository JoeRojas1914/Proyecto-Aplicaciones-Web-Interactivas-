<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // // User::factory(10)->create();
        // Crear 3 usuarios de prueba
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('contrasena'),
            'rol' => 'usuario',
        ]);
        User::factory()->create([
            'name' => 'Test Critico',
            'email' => 'testcritico@example.com',
            'password' => bcrypt('contrasena'),
            'rol' => 'critico',
        ]);
        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'testadmin@example.com',
            'password' => bcrypt('contrasena'),
            'rol' => 'administrador',
        ]);

        // Crear 50 posts de prueba
        $this->call([
            PostSeeder::class,
        ]);
    }
}
