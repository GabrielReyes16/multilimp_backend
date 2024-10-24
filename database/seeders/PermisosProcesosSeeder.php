<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PermisoProceso;

class PermisosProcesosSeeder extends Seeder
{
    public function run()
    {
        $permisos = [
            ['nombre' => 'cotizaciones'],
            ['nombre' => 'ventas'],
            ['nombre' => 'op'],
            ['nombre' => 'tesoreria'],
            ['nombre' => 'seguimiento'],
            ['nombre' => 'facturacion'],
            ['nombre' => 'cobranzas']
        ];

        foreach ($permisos as $permiso) {
            PermisoProceso::create($permiso);
        }
    }
}
