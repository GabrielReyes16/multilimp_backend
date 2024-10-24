<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PermisoConfiguracion;

class PermisosConfiguracionSeeder extends Seeder
{
    public function run()
    {
        $permisos = [
            ['nombre' => 'transportes'],
            ['nombre' => 'clientes'],
            ['nombre' => 'proveedores'],
            ['nombre' => 'empresas']
        ];

        foreach ($permisos as $permiso) {
            PermisoConfiguracion::create($permiso);
        }
    }
}
