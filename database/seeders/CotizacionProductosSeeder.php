<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\CotizacionProducto;

class CotizacionProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CotizacionProducto::insert([
            [
                'codigo' => 'gfdgfds',
                'descripcion' => 'gfdsgfsdgfsdgsfd',
                'medida' => 'gfdsgfsdg',
                'p_cliente' => '45',
                'cantidad' => '45',
                'precio_unitario' => '7.0000',
                'total' => '315.00',
                'id_cotizacion' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'sdgfdsg',
                'descripcion' => 'dfgfsdgsf',
                'medida' => 'hgfhgdh',
                'p_cliente' => '5',
                'cantidad' => '5',
                'precio_unitario' => '87.0000',
                'total' => '435.00',
                'id_cotizacion' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'PULSSB',
                'descripcion' => 'PULVERIZADORES Y ATOMIZADORES : ATOMIZADOR COMPLETO DE: POLIETILENO ERGONÓMICO CON CABEZAL AJUSTABLE ALTO: 215 MM DIAMETRO: 67 MM INCLUYE FRASCO G.F: 6 MESES UNIDAD',
                'medida' => null,
                'p_cliente' => '70',
                'cantidad' => '70',
                'precio_unitario' => '4.0000',
                'total' => '280.00',
                'id_cotizacion' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'PULSSB',
                'descripcion' => 'PULVERIZADORES Y ATOMIZADORES : ATOMIZADOR COMPLETO DE: POLIETILENO ERGONÓMICO CON CABEZAL AJUSTABLE ALTO: 215 MM DIAMETRO: 67 MM INCLUYE FRASCO G.F: 6 MESES UNIDAD',
                'medida' => null,
                'p_cliente' => '70',
                'cantidad' => '70',
                'precio_unitario' => '4.0000',
                'total' => '280.00',
                'id_cotizacion' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Agregar más registros si es necesario
        ]);
    }
}
