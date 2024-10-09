<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactoCliente;

class ContactoClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactoCliente::insert([
            [
                'id' => 29,
                'nombre' => 'angel',
                'telefono' => '999999999',
                'correo' => 'juan@yahoo.es',
                'cargo' => 'vendedor',
                'id_cliente' => '18',
                'estado' => null,
                'created_at' => null,
                'updated_at' => '2024-01-13 15:50:00',
            ],
            [
                'id' => 30,
                'nombre' => 'Angel Fabian',
                'telefono' => '941382564',
                'correo' => 'angel@avadtar.com',
                'cargo' => 'vendedor',
                'id_cliente' => '19',
                'estado' => null,
                'created_at' => null,
                'updated_at' => '2024-01-13 15:50:00',
            ],
            [
                'id' => 31,
                'nombre' => 'Angel Fabian de la Cruz Robles',
                'telefono' => '941382564',
                'correo' => 'angel@avadtar.com',
                'cargo' => 'vendedor',
                'id_cliente' => '20',
                'estado' => null,
                'created_at' => null,
                'updated_at' => '2023-10-18 19:07:13',
            ],
            [
                'id' => 32,
                'nombre' => 'Angel',
                'telefono' => '999888777',
                'correo' => 'angel@avadtar.com',
                'cargo' => 'vendedor',
                'id_cliente' => '21',
                'estado' => 1,
                'created_at' => null,
                'updated_at' => '2024-01-30 17:34:27',
            ],
            [
                'id' => 38,
                'nombre' => 'Angel',
                'telefono' => '939443169',
                'correo' => 'angel@avadtar.com',
                'cargo' => 'administrativo',
                'id_cliente' => '22',
                'estado' => null,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 39,
                'nombre' => 'Juan Ernesto',
                'telefono' => '941382564',
                'correo' => 'juan@avadtar.com',
                'cargo' => 'administrativo',
                'id_cliente' => '23',
                'estado' => null,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 40,
                'nombre' => 'Melissa',
                'telefono' => '999999999',
                'correo' => 'melissa@avadtar.com',
                'cargo' => 'vendedor',
                'id_cliente' => '24',
                'estado' => null,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 41,
                'nombre' => 'angel',
                'telefono' => '941382564',
                'correo' => 'angel@avadtar.com',
                'cargo' => 'administrativo',
                'id_cliente' => '18',
                'estado' => null,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 42,
                'nombre' => 'Juan Ernesto',
                'telefono' => '941382564',
                'correo' => 'juan@yahoo.es',
                'cargo' => 'vendedor',
                'id_cliente' => '19',
                'estado' => null,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 43,
                'nombre' => 'Melissa',
                'telefono' => '969735560',
                'correo' => 'melissa@avadtar.com',
                'cargo' => 'vendedor',
                'id_cliente' => '20',
                'estado' => null,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 51,
                'nombre' => 'angel',
                'telefono' => '941382564',
                'correo' => 'angel@avadtar.com',
                'cargo' => 'Gerencia',
                'id_cliente' => '21',
                'estado' => null,
                'created_at' => null,
                'updated_at' => '2023-10-24 23:05:07',
            ],
            [
                'id' => 52,
                'nombre' => 'AVADTAR S.A.C.',
                'telefono' => '999888777',
                'correo' => 'juan@avadtar.com',
                'cargo' => 'Marketing',
                'id_cliente' => '22',
                'estado' => null,
                'created_at' => null,
                'updated_at' => '2023-10-24 23:05:07',
            ],
        ]);
    }
}
