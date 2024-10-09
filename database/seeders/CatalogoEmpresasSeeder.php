<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CatalogoEmpresa;

class CatalogoEmpresasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CatalogoEmpresa::insert([
            [
                'id' => 13,
                'codigo' => 'EXT-CE-2021-3',
                'id_empresa' => 7,
                'created_at' => '2024-01-08 17:35:26',
                'updated_at' => '2024-02-09 20:21:53',
            ],
            [
                'id' => 14,
                'codigo' => 'EXT-CE-2021-3',
                'id_empresa' => 8,
                'created_at' => '2024-01-25 14:47:19',
                'updated_at' => '2024-02-23 15:11:58',
            ],
            [
                'id' => 15,
                'codigo' => 'EXT-CE-2023-1',
                'id_empresa' => 9,
                'created_at' => '2024-02-09 15:43:37',
                'updated_at' => '2024-02-09 15:43:37',
            ],
            [
                'id' => 16,
                'codigo' => 'EXT-CE-2021-3',
                'id_empresa' => 11,
                'created_at' => '2024-02-09 15:44:00',
                'updated_at' => '2024-02-09 15:44:00',
            ],
            [
                'id' => 17,
                'codigo' => 'EXT-CE-2021-3',
                'id_empresa' => 10,
                'created_at' => '2024-02-09 15:46:38',
                'updated_at' => '2024-02-09 15:46:38',
            ],
            [
                'id' => 18,
                'codigo' => 'IM-CE-2021-20',
                'id_empresa' => 11,
                'created_at' => '2024-02-12 14:02:25',
                'updated_at' => '2024-02-12 14:02:25',
            ],
            [
                'id' => 19,
                'codigo' => 'EXT-CE-2023-20',
                'id_empresa' => 11,
                'created_at' => '2024-02-21 14:42:22',
                'updated_at' => '2024-02-21 14:42:22',
            ],
            [
                'id' => 20,
                'codigo' => 'CAT-001',
                'id_empresa' => 12,
                'created_at' => '2024-05-24 13:45:19',
                'updated_at' => '2024-05-24 13:45:19',
            ],
            [
                'id' => 21,
                'codigo' => 'EXT-CE-2024-3',
                'id_empresa' => 11,
                'created_at' => '2024-06-27 13:46:24',
                'updated_at' => '2024-06-27 13:46:24',
            ],
            [
                'id' => 22,
                'codigo' => 'EXT-CE-2024-3',
                'id_empresa' => 9,
                'created_at' => '2024-06-27 14:27:46',
                'updated_at' => '2024-06-27 14:27:46',
            ],
            [
                'id' => 23,
                'codigo' => 'EXT-CE-2024-3',
                'id_empresa' => 8,
                'created_at' => '2024-06-27 14:28:03',
                'updated_at' => '2024-06-27 14:28:03',
            ],
            [
                'id' => 24,
                'codigo' => 'EXT-CE-2024-3',
                'id_empresa' => 7,
                'created_at' => '2024-06-27 14:28:20',
                'updated_at' => '2024-06-27 14:28:20',
            ],
            [
                'id' => 25,
                'codigo' => 'EXT-CE-2023-16',
                'id_empresa' => 9,
                'created_at' => '2024-08-23 17:17:53',
                'updated_at' => '2024-08-23 17:17:53',
            ],
        ]);
    }
}
