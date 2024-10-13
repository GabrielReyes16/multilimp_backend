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
            //seeders iniciales
            RoleSeeder::class,
            UserSeeder::class,
            ClienteSeeder::class,
            EmpresaSeeder::class,
            ProveedorSeeder::class,
            TransporteSeeder::class,
            //Seeders para proceso ventas
            SeguimientosSeeder::class,
            ContrasSeeder::class,
            ContactoClientesSeeder::class,
            CatalogoEmpresasSeeder::class,
            //Seeders para proceso Orden de Proveedores
            ContactoProveedoresSeeder::class,
            ContactoTransportesSeeder::class,
            OpProductosSeeder::class,
            OrdenPedidosSeeder::class,
            //Seeders para cotizacion
        ]);
    }
}
