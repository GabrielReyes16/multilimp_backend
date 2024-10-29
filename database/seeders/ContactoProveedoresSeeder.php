<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactoProveedor;

class ContactoProveedoresSeeder extends Seeder
{
    public function run()
    {
        ContactoProveedor::create([
            'id' => 1,
            'nombre' => 'Angel Fabian de la Cruz Robles',
            'telefono' => '939443169',
            'correo' => 'angel@avadtar.com',
            'cargo' => 'Administrador',
            'id_proveedor' => '2',
            'estado' => null,
            'created_at' => '2023-10-18 16:58:45',
            'updated_at' => null,
        ]);

        ContactoProveedor::create([
            'id' => 2,
            'nombre' => 'Juan',
            'telefono' => '941382564',
            'correo' => 'juan@avadtar.com',
            'cargo' => 'administrativo',
            'id_proveedor' => '2',
            'estado' => null,
            'created_at' => '2023-10-18 16:58:46',
            'updated_at' => null,
        ]);

        ContactoProveedor::create([
            'id' => 3,
            'nombre' => 'Rosa',
            'telefono' => '941382564',
            'correo' => 'rosa@avadtar.com',
            'cargo' => 'administrativo',
            'id_proveedor' => '2',
            'estado' => null,
            'created_at' => '2023-10-18 16:58:45',
            'updated_at' => null,
        ]);

        ContactoProveedor::create([
            'id' => 4,
            'nombre' => 'Roberto',
            'telefono' => '969735560',
            'correo' => 'roberto@gmail.com',
            'cargo' => 'administrativo',
            'id_proveedor' => '2',
            'estado' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);

        ContactoProveedor::create([
            'id' => 5,
            'nombre' => 'Angel de la Cruz',
            'telefono' => '939443169',
            'correo' => 'angel@avadtar.com',
            'cargo' => 'Administrador',
            'id_proveedor' => '1',
            'estado' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);

        ContactoProveedor::create([
            'id' => 6,
            'nombre' => 'FLOR',
            'telefono' => '953554237',
            'correo' => 'EBRIEL@OUTLOOK.COM',
            'cargo' => 'VENDEDORA',
            'id_proveedor' => '3',
            'estado' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
    }
}
