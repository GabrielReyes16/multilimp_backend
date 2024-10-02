<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('proveedores')->insert([
            [
                'id' => 1,
                'ruc' => '20609660491',
                'razon_social' => 'Avadtar S.A.C.',
                'departamento' => 'lima',
                'provincia' => 'Lima',
                'distrito' => 'Lima Centro',
                'direccion' => 'Av. Los alpinos 456',
                'monto' => null,
                'estado' => null,
                'created_at' => null,
                'updated_at' => Carbon::create('2023-10-19 14:20:55'),
            ],
            [
                'id' => 2,
                'ruc' => '20458721598',
                'razon_social' => 'Proveedores S.A.C.',
                'departamento' => 'lima',
                'provincia' => 'Callao',
                'distrito' => 'Callao Centro',
                'direccion' => 'Av. Los Libertadores SJL 157',
                'monto' => '59.00',
                'estado' => 1,
                'created_at' => null,
                'updated_at' => Carbon::create('2024-02-12 21:26:17'),
            ],
            [
                'id' => 3,
                'ruc' => '20515374087',
                'razon_social' => 'EBRIEL LINEA EMPRESARIAL E.I.R.L.',
                'departamento' => 'LIMA',
                'provincia' => 'LIMA',
                'distrito' => 'LA VICTORIA',
                'direccion' => 'JR. REBAGLIATI N° 123',
                'monto' => '-10.00',
                'estado' => 1,
                'created_at' => null,
                'updated_at' => Carbon::create('2024-01-23 14:58:51'),
            ],
            [
                'id' => 14,
                'ruc' => '20603950675',
                'razon_social' => 'SERVICIO DE CONSTRUCCION Y LIMPIEZA EMPRESA INDIVIDUAL DE RESPONSABILIDAD LIMITADA',
                'departamento' => 'LAMBAYEQUE',
                'provincia' => 'CHICLAYO',
                'distrito' => 'CHICLAYO',
                'direccion' => 'MZA. Q LOTE. 3 URB. LA PARADA',
                'monto' => '1300.00',
                'estado' => null,
                'created_at' => null,
                'updated_at' => Carbon::create('2024-02-12 21:14:16'),
            ],
            [
                'id' => 15,
                'ruc' => '20131373075',
                'razon_social' => 'SERVICIO NACIONAL DE SANIDAD AGRARIA',
                'departamento' => 'LIMA',
                'provincia' => 'LIMA',
                'distrito' => 'LA MOLINA',
                'direccion' => 'Av. La Molina 1915',
                'monto' => null,
                'estado' => 1,
                'created_at' => null,
                'updated_at' => Carbon::create('2024-02-12 21:23:16'),
            ],
        ]);
    }
}
