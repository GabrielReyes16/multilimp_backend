<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BancoProveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // IDs de proveedores existentes
        $proveedores = [1, 2, 3, 14, 15];

        // Información de ejemplo para los bancos
        $bancos = [
            ['nombre' => 'Banco de Crédito del Perú', 'numero_cuenta' => '001-1234567890'],
            ['nombre' => 'Interbank', 'numero_cuenta' => '002-9876543210'],
            ['nombre' => 'BBVA Continental', 'numero_cuenta' => '003-1122334455'],
            ['nombre' => 'Scotiabank', 'numero_cuenta' => '004-5566778899'],
            ['nombre' => 'Banco Pichincha', 'numero_cuenta' => '005-9988776655'],
        ];

        // Asignar al menos un banco a cada proveedor
        foreach ($proveedores as $index => $idProveedor) {
            DB::table('banco_proveedores')->insert([
                'id_proveedor' => $idProveedor,
                'numero_cuenta' => $bancos[$index % count($bancos)]['numero_cuenta'],
                'nombre_banco' => $bancos[$index % count($bancos)]['nombre'],
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
