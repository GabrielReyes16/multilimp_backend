<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\MODELS\OpProducto;

class OpProductosSeeder extends Seeder
{
    public function run()
    {
        OpProducto::create([
            'id' => 1,
            'codigo' => '360484',
            'descripcion' => 'PAPEL TOALLA: INTERFOLIADO- UNAHOJACOL: NATURAL 250 HOJAS C/U 21.6 CMX21.0 CMC/U 38 GR/M2 GOFRADO\nG.F: 12 MESESONSITECAJAX18 PAQUETESELITE360484',
            'medida' => null,
            'p_cliente' => '20',
            'almacen' => '0',
            'cantidad' => '20',
            'precio_unitario' => '105.6100',
            'total' => '2112.20',
            'id_orden_pedido' => 'OP-GES-1-1',
            'id_seguimiento' => 'OC-GES-1',
            'created_at' => null,
            'updated_at' => null,
        ]);

        OpProducto::create([
            'id' => 2,
            'codigo' => '73747',
            'descripcion' => 'PAPEL TOALLA: DOBLEHOJACOL: NATURAL 120 MTSC/U17.7 CMX19.5 CMC/U 45 GR/M2 GOFRADOG.F: 12 MESESON\nSITECAJAX6 ROLLOSFAMILIAINSTITUCIONAL 73747',
            'medida' => null,
            'p_cliente' => '350',
            'almacen' => '0',
            'cantidad' => '350',
            'precio_unitario' => '94.7068',
            'total' => '33147.38',
            'id_orden_pedido' => 'OP-GES-2-1',
            'id_seguimiento' => 'OC-GES-2',
            'created_at' => null,
            'updated_at' => null,
        ]);

        OpProducto::create([
            'id' => 6,
            'codigo' => 'TBAAO1206045',
            'descripcion' => 'TOALLAS : FELPA 100% ALGODON LARGO: 130 CMANCHO: 60 CM 450 GR BAÑOAZUL G.F: 6 MESES UNIDAD MARCA:\nAPOLOTOALLAAPOLODEBAÑOAZUL TBAAO1206045',
            'medida' => null,
            'p_cliente' => '278',
            'almacen' => '0',
            'cantidad' => '278',
            'precio_unitario' => '26.0000',
            'total' => '6950.00',
            'id_orden_pedido' => 'OP-GES-4-1',
            'id_seguimiento' => 'OC-GES-4',
            'created_at' => null,
            'updated_at' => null,
        ]);

        OpProducto::create([
            'id' => 7,
            'codigo' => 'TBAAO1206045',
            'descripcion' => 'TOALLAS : FELPA 100% ALGODON LARGO: 120 CMANCHO: 60 CM 450 GR BAÑOAZUL G.F: 6 MESES UNIDAD MARCA:\nAPOLOTOALLAAPOLODEBAÑOAZUL TBAAO1206045',
            'medida' => null,
            'p_cliente' => '112',
            'almacen' => '0',
            'cantidad' => '112',
            'precio_unitario' => '25.0000',
            'total' => '2800.00',
            'id_orden_pedido' => 'OP-GES-5-1',
            'id_seguimiento' => 'OC-GES-5',
            'created_at' => null,
            'updated_at' => null,
        ]);

        OpProducto::create([
            'id' => 8,
            'codigo' => 'TBAAO1206045',
            'descripcion' => 'TOALLAS : FELPA 100% ALGODON LARGO: 120 CMANCHO: 60 CM 450 GR BAÑOAZUL G.F: 6 MESES UNIDAD MARCA:\nAPOLOTOALLAAPOLODEBAÑOAZUL TBAAO1206045',
            'medida' => null,
            'p_cliente' => '148',
            'almacen' => '0',
            'cantidad' => '148',
            'precio_unitario' => '25.0000',
            'total' => '3700.00',
            'id_orden_pedido' => 'OP-GES-6-1',
            'id_seguimiento' => 'OC-GES-6',
            'created_at' => null,
            'updated_at' => null,
        ]);
    }
}
