<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llamamos a los seeders que quieres ejecutar
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ClienteSeeder::class,
            EmpresaSeeder::class,
            ProveedorSeeder::class,
            TransporteSeeder::class,
            SeguimientosSeeder::class,
            ContrasSeeder::class,
            ContactoClientesSeeder::class,
            CatalogoEmpresasSeeder::class,
        ]);
    }
}
