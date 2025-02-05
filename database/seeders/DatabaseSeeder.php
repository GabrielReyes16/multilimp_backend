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
            ClienteSeeder::class,
            EmpresaSeeder::class,
            ProveedorSeeder::class,
            BancoProveedoresSeeder::class,
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
            CotizacionSeeder::class,
            CotizacionProductosSeeder::class,

            //Seeders para facturacion'
            FacturacionSeeder::class,

            //Users
            PermisosConfiguracionSeeder::class,
            PermisosProcesosSeeder::class,

            //Seeders para un admin
            UserSeeder::class,
            PermissionsSeeder::class,

        ]);
    }
}
