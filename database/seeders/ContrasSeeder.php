<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contra;

class ContrasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contra::insert([
            [
                'id' => 1,
                'contra' => 'ESP71938',
                'created_at' => null,
                'updated_at' => '2024-05-28 19:32:54',
            ]
        ]);
    }
}
