<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Cotizacion;
use Illuminate\Support\Facades\DB;

class CotizacionSeeder extends Seeder
{
    public function run()
    {
        DB::table('cotizaciones')->insert([
            [
                'id' => 1,
                'id_cotizacion' => 'COTIZ-GRU-1',
                'id_empresa' => 7,
                'id_cliente' => 18,
                'id_contacto_cliente' => 39,
                'monto' => 750.00,
                'tipo_pago' => 'Pago al Contado',
                'nota_pago' => 'sdfdasfdasfdasf',
                'nota_pedido' => DB::raw("CONVERT('asfdasfdasfdasf' USING utf8mb4)"),
                'c_direccion' => null,
                'c_distrito' => 'Lima',
                'c_provincia' => 'Lima',
                'c_departamento' => 'Lima',
                'c_referencia' => null,
                'estado' => 'Aprobado',
                'fecha_cotizacion' => '2024-06-03',
                'fecha_entrega' => '2024-06-06',
                'created_at' => '2024-06-03 19:03:33',
                'updated_at' => '2024-06-04 21:35:09'
            ],
            [
                'id' => 2,
                'id_cotizacion' => 'COTIZ-MUL-1',
                'id_empresa' => 8,
                'id_cliente' => 22,
                'id_contacto_cliente' => 29,
                'monto' => 280.00,
                'tipo_pago' => null,
                'nota_pago' => null,
                'nota_pedido' => null,
                'c_direccion' => null,
                'c_distrito' => null,
                'c_provincia' => null,
                'c_departamento' => null,
                'c_referencia' => null,
                'estado' => 'Enviado',
                'fecha_cotizacion' => '2024-06-05',
                'fecha_entrega' => null,
                'created_at' => '2024-06-05 15:14:52',
                'updated_at' => '2024-06-05 15:44:02'
            ],
            [
                'id' => 3,
                'id_cotizacion' => 'COTIZ-MUL-2',
                'id_empresa' => 8,
                'id_cliente' => 21,
                'id_contacto_cliente' => 32,
                'monto' => 280.00,
                'tipo_pago' => 'Pago al Contado',
                'nota_pago' => null,
                'nota_pedido' => null,
                'c_direccion' => null,
                'c_distrito' => null,
                'c_provincia' => null,
                'c_departamento' => null,
                'c_referencia' => null,
                'estado' => 'Pendiente',
                'fecha_cotizacion' => '2024-06-05',
                'fecha_entrega' => '2024-06-11',
                'created_at' => '2024-06-05 15:16:56',
                'updated_at' => '2024-06-05 15:16:56'
            ],
        ]);
    }
}
