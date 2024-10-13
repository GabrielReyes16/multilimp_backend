<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactoTransporte;

class ContactoTransportesSeeder extends Seeder
{
    public function run()
    {
        ContactoTransporte::create([
            'id' => 1,
            'nombre' => 'Angel',
            'telefono' => '939443169',
            'correo' => 'angel@avadtar.com',
            'cargo' => 'Administrador',
            'id_cliente' => '1',
            'estado' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);

        ContactoTransporte::create([
            'id' => 2,
            'nombre' => 'Juan',
            'telefono' => '941382564',
            'correo' => 'juan@avadtar.com',
            'cargo' => 'administrativo',
            'id_cliente' => '1',
            'estado' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);

        ContactoTransporte::create([
            'id' => 3,
            'nombre' => 'Rosa',
            'telefono' => '969735550',
            'correo' => 'rosa@avadtar.com',
            'cargo' => 'administrativo',
            'id_cliente' => '1',
            'estado' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);

        ContactoTransporte::create([
            'id' => 4,
            'nombre' => 'Angel Fabian',
            'telefono' => '939443169',
            'correo' => 'angel@avadtar.com',
            'cargo' => 'administrativo',
            'id_cliente' => '2',
            'estado' => null,
            'created_at' => '2023-10-18 17:30:54',
            'updated_at' => null,
        ]);

        ContactoTransporte::create([
            'id' => 5,
            'nombre' => 'Rosa',
            'telefono' => '999999999',
            'correo' => 'rosa@avadtar.com',
            'cargo' => 'administrativo',
            'id_cliente' => '2',
            'estado' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);

        ContactoTransporte::create([
            'id' => 6,
            'nombre' => 'Juan Ernesto',
            'telefono' => '941382564',
            'correo' => 'juan@avadtar.com',
            'cargo' => 'administrativo',
            'id_cliente' => '2',
            'estado' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
    }
}
