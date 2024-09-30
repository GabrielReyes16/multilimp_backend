<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ejemplo de datos para usuarios
        User::create([
            'name' => 'math',
            'email' => 'math@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),  // Encripta la contraseña
            'remember_token' => \Str::random(10),
            'nombre' => 'Math',
            'apellido' => 'Reyes',
            'role_id' => 1,  // Suponiendo que el ID 1 es para un rol de admin
            'foto' => 'math.jpg',  // Archivo de foto de perfil
        ]);
        User::create([
            'name' => 'harold',
            'email' => 'harold@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),  // Encripta la contraseña
            'remember_token' => \Str::random(10),
            'nombre' => 'Harold',
            'apellido' => 'Medrano',
            'role_id' => 1,  // Suponiendo que el ID 1 es para un rol de admin
            'foto' => 'harold.jpg',  // Archivo de foto de perfil
        ]);

        User::create([
            'name' => 'marcelo',
            'email' => 'marcelo@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => \Str::random(10),
            'nombre' => 'Marcelo',
            'apellido' => 'Sanabria',
            'role_id' => 2,  // Suponiendo que el ID 2 es para un rol de usuario normal
            'foto' => 'marcelo.jpg',
        ]);
    }
}
