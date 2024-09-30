<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use Carbon\Carbon;

class ClienteSeeder extends Seeder
{
    public function run()
    {
        Cliente::create([
            'id' => 5,
            'ruc' => '10741381481',
            'razon_social' => 'Alquimias',
            'cod_unidad' => '34',
            'departamento' => 'lima',
            'provincia' => 'Lima',
            'distrito' => 'Lima Centro',
            'direccion' => 'MZ. E LT. 12 URB. SANTA CLARA LIMA - LIMA - ATE',
            'estado' => NULL,
            'created_at' => Carbon::parse('2024-01-11 16:26:50'),
            'updated_at' => NULL,
        ]);

        Cliente::create([
            'id' => 6,
            'ruc' => '20609660491',
            'razon_social' => 'Alquimia SAC',
            'cod_unidad' => '12',
            'departamento' => 'lima',
            'provincia' => 'Lima',
            'distrito' => 'Lima Centro',
            'direccion' => 'AV. JUAN NICOLINI NRO. 186 URB. PALAO ET 1 LIMA - LIMA - SAN MARTIN DE PORRES',
            'estado' => NULL,
            'created_at' => Carbon::parse('2024-01-11 16:22:59'),
            'updated_at' => NULL,
        ]);

        Cliente::create([
            'id' => 7,
            'ruc' => '234324324324',
            'razon_social' => 'Parking',
            'cod_unidad' => 'safas',
            'departamento' => 'lima',
            'provincia' => 'Callao',
            'distrito' => 'Carmen de la Legua',
            'direccion' => 'MZ. E LT. 12 URB. SANTA CLARA LIMA - LIMA - ATE',
            'estado' => NULL,
            'created_at' => Carbon::parse('2024-01-11 16:22:28'),
            'updated_at' => NULL,
        ]);

        Cliente::create([
            'id' => 8,
            'ruc' => '20609660491',
            'razon_social' => 'Baltalab',
            'cod_unidad' => '234543',
            'departamento' => 'lima',
            'provincia' => 'Lima',
            'distrito' => 'Lima Centro',
            'direccion' => 'MZ. E LT. 12 URB. SANTA CLARA LIMA - LIMA - ATE',
            'estado' => NULL,
            'created_at' => Carbon::parse('2024-01-11 16:22:55'),
            'updated_at' => NULL,
        ]);

        Cliente::create([
            'id' => 18,
            'ruc' => '20609660491',
            'razon_social' => 'Clinica fe',
            'cod_unidad' => '5654645',
            'departamento' => 'lima',
            'provincia' => 'Lima',
            'distrito' => 'Lima Centro',
            'direccion' => 'AV. JUAN NICOLINI NRO. 186 URB. PALAO ET 1 LIMA - LIMA - SAN MARTIN DE PORRES',
            'estado' => NULL,
            'created_at' => Carbon::parse('2024-01-11 16:22:49'),
            'updated_at' => NULL,
        ]);

        Cliente::create([
            'id' => 19,
            'ruc' => '20609660491',
            'razon_social' => 'Conecta 2.0',
            'cod_unidad' => '234543',
            'departamento' => 'lima',
            'provincia' => 'Lima',
            'distrito' => 'Lima Centro',
            'direccion' => 'AV. TUPAC AMARU N° 210 - RIMAC - LIMA',
            'estado' => NULL,
            'created_at' => Carbon::parse('2024-01-11 16:22:45'),
            'updated_at' => NULL,
        ]);

        Cliente::create([
            'id' => 20,
            'ruc' => '20609660491',
            'razon_social' => 'KidsCity',
            'cod_unidad' => '234543',
            'departamento' => 'lima',
            'provincia' => 'Callao',
            'distrito' => 'Carmen de la Legua',
            'direccion' => 'AV. JUAN NICOLINI NRO. 186 URB. PALAO ET 1 LIMA - LIMA - SAN MARTIN DE PORRES',
            'estado' => NULL,
            'created_at' => Carbon::parse('2024-01-11 16:22:40'),
            'updated_at' => NULL,
        ]);

        Cliente::create([
            'id' => 21,
            'ruc' => '20609660491',
            'razon_social' => 'Avadtar S.A.C.',
            'cod_unidad' => '2010',
            'departamento' => 'Lima',
            'provincia' => 'Lima',
            'distrito' => 'SMP',
            'direccion' => 'Av. Juan Nicolini 186',
            'estado' => 1,
            'created_at' => Carbon::parse('2024-01-25 14:00:58'),
            'updated_at' => NULL,
        ]);

        Cliente::create([
            'id' => 22,
            'ruc' => '20131257750',
            'razon_social' => 'SEGURO SOCIAL DE SALUD',
            'cod_unidad' => '401621',
            'departamento' => 'TRUJILLO',
            'provincia' => 'TRUJILLO',
            'distrito' => 'LA LIBERTAD',
            'direccion' => 'JULIO GUTIERREZ 322 - URB. LOS JARDINES',
            'estado' => 1,
            'created_at' => Carbon::parse('2024-07-18 14:32:17'),
            'updated_at' => NULL,
        ]);

        Cliente::create([
            'id' => 23,
            'ruc' => '20172557628',
            'razon_social' => 'UNIVERSIDAD NACIONAL DE TRUJILLO',
            'cod_unidad' => '90',
            'departamento' => 'LA LIBERTAD',
            'provincia' => 'TRUJILLO',
            'distrito' => 'TRUJILLO',
            'direccion' => 'CAL.DIEGO DE ALMAGRO NRO. 344',
            'estado' => NULL,
            'created_at' => Carbon::parse('2024-01-11 16:25:45'),
            'updated_at' => NULL,
        ]);

        Cliente::create([
            'id' => 24,
            'ruc' => '20601353874',
            'razon_social' => 'UNIVERSIDAD NACIONAL DE TRUJILLO',
            'cod_unidad' => '134',
            'departamento' => NULL,
            'provincia' => NULL,
            'distrito' => NULL,
            'direccion' => NULL,
            'estado' => NULL,
            'created_at' => Carbon::parse('2024-01-11 16:23:04'),
            'updated_at' => NULL,
        ]);
    }
}
