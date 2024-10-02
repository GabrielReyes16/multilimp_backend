<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transportes')->insert([
            [
                'id' => 2,
                'ruc' => '20609660490',
                'razon_social' => 'Transportes S.A.C.',
                'departamento' => 'lima',
                'provincia' => 'Lima',
                'distrito' => 'Lima Centro',
                'direccion' => 'Av. Los alpinos 456',
                'cobertura' => null,
                'estado' => null,
                'created_at' => null,
                'updated_at' => Carbon::create('2023-10-18 17:31:25'),
            ],
            [
                'id' => 3,
                'ruc' => '78454782316',
                'razon_social' => 'Transporta2 S.A.C.',
                'departamento' => 'lima',
                'provincia' => 'Lima',
                'distrito' => 'Lima Centro',
                'direccion' => 'Av. La marina 147',
                'cobertura' => 'Trujillo, Piura, Junín',
                'estado' => null,
                'created_at' => null,
                'updated_at' => Carbon::create('2023-12-19 15:16:41'),
            ],
            [
                'id' => 4,
                'ruc' => '20600876211',
                'razon_social' => 'GRAU LOGISTICA EXPRESS S.A.',
                'departamento' => 'LIMA',
                'provincia' => 'LIMA',
                'distrito' => 'ATE',
                'direccion' => 'AV. EVITAMIENTO MZ. B LOTE 12 Y 13 - ATE 1502',
                'cobertura' => 'PIURA, LA LIBERTAD',
                'estado' => null,
                'created_at' => null,
                'updated_at' => Carbon::create('2024-04-09 19:06:24'),
            ],
            [
                'id' => 5,
                'ruc' => '20603369930',
                'razon_social' => 'TRANSPORTES BERTHA CANTURIN E.I.R.L.',
                'departamento' => 'CALLAO',
                'provincia' => 'PROV. CONST DEL CALLAO',
                'distrito' => 'CALLAO',
                'direccion' => 'AV. 28 DE JULIO 1928- La Victoria',
                'cobertura' => null,
                'estado' => null,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 6,
                'ruc' => '20603099088',
                'razon_social' => 'CORPORACION ACUARIO EXPRESS SOCIEDAD ANONIMA CERRADA - CORAEX S.A.C.',
                'departamento' => 'LIMA',
                'provincia' => 'LIMA',
                'distrito' => 'ATE',
                'direccion' => 'Cl. Sta.Teresa 190-192 Urb.Los sauces - ATE',
                'cobertura' => 'CUSCO',
                'estado' => null,
                'created_at' => null,
                'updated_at' => Carbon::create('2024-04-26 14:01:53'),
            ],
        ]);
    }
}
