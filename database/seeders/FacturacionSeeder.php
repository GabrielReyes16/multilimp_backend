<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facturacion;
use App\Models\Refacturacion;
use Carbon\Carbon;

class FacturacionSeeder extends Seeder
{
    public function run()
    {
        Facturacion::create([
            'id_venta' => 1,
            'factura' => 'F001-0001',
            'fecha_factura' => Carbon::parse('2024-01-11'),
            'grr' => 'GRR-0001',
            'retencion' => '2',
            'detraccion' => '4',
            'forma_envio' => 'Correo',
            'estado' => 1,
            'created_at' => Carbon::parse('2024-01-11'),
            'updated_at' => null,
        ]);

        Facturacion::create([
            'id_venta' => 2,
            'factura' => 'F001-0002',
            'fecha_factura' => Carbon::parse('2024-01-11'),
            'grr' => 'GRR-0002',
            'retencion' => '2',
            'detraccion' => '4',
            'forma_envio' => 'Correo',
            'estado' => 1,
            'created_at' => Carbon::parse('2024-01-11'),
            'updated_at' => null,
        ]);


        Refacturacion::create([
            'id_facturacion' => 1,
            'id_venta' => 1,
            'factura' => 'F001-0001',
            'fecha_factura' => Carbon::parse('2024-01-11'),
            'grr' => 'GRR-0001',
            'retencion' => '2',
            'detraccion' => '4',
            'forma_envio' => 'Correo',
            'estado' => 1,
            'created_at' => Carbon::parse('2024-01-11'),
            'updated_at' => null,
        ]);
        Refacturacion::create([
            'id_facturacion' => 1,
            'id_venta' => 1,
            'factura' => 'F001-0002',
            'fecha_factura' => Carbon::parse('2024-01-11'),
            'grr' => 'GRR-0001',
            'retencion' => '2',
            'detraccion' => '4',
            'forma_envio' => 'Correo',
            'estado' => 1,
            'created_at' => Carbon::parse('2024-01-11'),
            'updated_at' => null,
        ]);


        Refacturacion::create([
            'id_facturacion' => 2,
            'id_venta' => 2,
            'factura' => 'F001-0002',
            'fecha_factura' => Carbon::parse('2024-01-11'),
            'grr' => 'GRR-0002',
            'retencion' => '2',
            'detraccion' => '4',
            'forma_envio' => 'Correo',
            'estado' => 1,
            'created_at' => Carbon::parse('2024-01-11'),
            'updated_at' => null,
        ]);
    }
}
