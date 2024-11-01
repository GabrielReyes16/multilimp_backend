<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user_permiso_configuracion')->insert([
            [
                'user_id' => 1,
                'permiso_configuracion_id' => 1
            ],
            [
                'user_id' => 1,
                'permiso_configuracion_id' => 2
            ],
            [
                'user_id' => 1,
                'permiso_configuracion_id' => 3
            ],
            [
                'user_id' => 1,
                'permiso_configuracion_id' => 4
            ],
        ]);
        DB::table('user_permiso_proceso')->insert([
            [
                'user_id' => 1,
                'permiso_proceso_id' => 1
            ],
            [
                'user_id' => 1,
                'permiso_proceso_id' => 2
            ],
            [
                'user_id' => 1,
                'permiso_proceso_id' => 3
            ],
            [
                'user_id' => 1,
                'permiso_proceso_id' => 4
            ],
            [
                'user_id' => 1,
                'permiso_proceso_id' => 5
            ],
            [
                'user_id' => 1,
                'permiso_proceso_id' => 6
            ],
            [
                'user_id' => 1,
                'permiso_proceso_id' => 7
            ],
        ]);
    }
}
