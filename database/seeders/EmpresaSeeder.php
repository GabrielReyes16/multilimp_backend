<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Empresa;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Empresa::create([
            'id' => 7,
            'ruc' => '20602429131',
            'razon_social' => 'GESTION TRIBUTARIA S.A.C.',
            'cod_unidad' => null,
            'departamento' => 'JUNIN',
            'provincia' => 'HUANCAYO',
            'distrito' => 'EL TAMBO',
            'direccion' => 'JR. WIRACOCHA N° 367',
            'logo' => 'public/doc/LOGO-GESTIÓN.jpg',
            'correo' => 'contabilidad@multilimpsac.com',
            'web' => 'www.multilimpsac.com',
            'direcciones' => 'VENTAS: 981 342 655 - 981 349 346 JUNÍN: Jr. Wiracocha N° 367 El Tambo - Huancayo LIMA: Calle Buenos Aires N° 231 (primera cuadra de Juan Fannig) - Miraflores - www.multilimpsac.com',
            'telefono' => '960 388 456',
            'estado' => null,
            'created_at' => '2024-02-13 22:01:01',
            'updated_at' => '2024-02-13 22:01:01',
        ]);

        Empresa::create([
            'id' => 8,
            'ruc' => '20608980963',
            'razon_social' => 'MULTILIMP S.A.C.',
            'cod_unidad' => null,
            'departamento' => 'JUNIN',
            'provincia' => 'HUANCAYO',
            'distrito' => 'EL TAMBO',
            'direccion' => 'JR. WIRACOCHA N° 367',
            'logo' => 'public/doc/logo_multilimp.png',
            'correo' => 'ventas@multilimpsac.com',
            'web' => 'www.multilimpsac.com',
            'direcciones' => 'JUNÍN: Jr. Wiracocha N° 367 El Tambo - Huancayo LIMA: Calle Buenos Aires N° 231  (primera cuadra de Juan Fannig) - Miraflores - www.multilimpsac.com',
            'telefono' => '960 388 456',
            'estado' => null,
            'created_at' => '2024-02-09 15:53:57',
            'updated_at' => '2024-02-09 15:53:57',
        ]);

        Empresa::create([
            'id' => 9,
            'ruc' => '20610777792',
            'razon_social' => 'SENIORS PLUS E.I.R.L.',
            'cod_unidad' => null,
            'departamento' => 'JUNIN',
            'provincia' => 'HUANCAYO',
            'distrito' => 'EL TAMBO',
            'direccion' => 'JR. WIRACOCHA N° 367',
            'logo' => 'public/doc/LOGO-SENIORS.jpg',
            'correo' => 'contabilidad@multilimpsac.com',
            'web' => 'www.multilimpsac.com',
            'direcciones' =>'JUNÍN: Jr. Wiracocha N° 367 El Tambo - Huancayo LIMA: Calle Buenos Aires N° 231 (primera cuadra de Juan Fannig) - Miraflores - www.multilimpsac.com',
            'telefono' => '960 388 456',
            'estado' => null,
            'created_at' => null,
            'updated_at' => '2024-02-13 22:03:16',
        ]);
    }
}
