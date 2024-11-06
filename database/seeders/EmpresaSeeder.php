<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Empresa;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
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
            'logo' => 'logos/LOGO-GESTIÓN.jpg',
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
            'logo' => 'logos/logo_multilimp.png',
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
            'logo' => 'logos/LOGO-SENIORS.jpg',
            'correo' => 'contabilidad@multilimpsac.com',
            'web' => 'www.multilimpsac.com',
            'direcciones' =>'JUNÍN: Jr. Wiracocha N° 367 El Tambo - Huancayo LIMA: Calle Buenos Aires N° 231 (primera cuadra de Juan Fannig) - Miraflores - www.multilimpsac.com',
            'telefono' => '960 388 456',
            'estado' => null,
            'created_at' => null,
            'updated_at' => '2024-02-13 22:03:16',
        ]);

        Empresa::create([
            'id' => 10,
            'ruc' => '20606951711',
            'razon_social' => 'ECOLIMP EMPRESARIAL E.I.R.L.',
            'cod_unidad' => null,
            'departamento' => 'JUNIN',
            'provincia' => 'HUANCAYO',
            'distrito' => 'CHILCA',
            'direccion' => 'PJ. ORELLANA  MZA. l LOTE. 44 (1.5cdrs de parque peñaloza)',
            'logo' => 'logos/LOGO-ECOLIMP-EMPRESARIAL.jpg',
            'correo' => 'contabilidad@multilimpsac.com',
            'web' => 'www.multilimpsac.com',
            'direcciones' =>'JUNÍN: Pj. Orellana Mza. l Lote. 44 Chilca - Huancayo LIMA: Calle Buenos Aires N° 231 (primera cuadra de Juan Fannig) - Miraflores - www.multilimpsac.com',
            'telefono' => '922 645 568',
            'estado' => null,
            'created_at' => null,
            'updated_at' => '2024-02-13 22:38:48',
        ]);

        Empresa::create([
            'id' => 11,
            'ruc' => '20611043873',
            'razon_social' => 'GRUPO ECOLIMP E.I.R.L.',
            'cod_unidad' => null,
            'departamento' => 'JUNIN',
            'provincia' => 'HUANCAYO',
            'distrito' => 'EL TAMBO',
            'direccion' => 'JR. JOSE GALVEZ BARRENECHEA NRO. 117',
            'logo' => 'logos/LOGO-GRUPO-ECOLIMP.jpg',
            'correo' => 'contabilidad@multilimpsac.com',
            'web' => 'www.multilimpsac.com',
            'direcciones' =>'JUNÍN: Jr. Jose Galvez Barrenechea N° 117 - Huancayo; LIMA: Calle Buenos Aires N° 231 (primera cuadra de Juan Fannig) - Miraflores - www.multilimpsac.com',
            'telefono' => '981 342 655',
            'estado' => null,
            'created_at' => null,
            'updated_at' => '2024-02-13 22:08:00',
        ]);

        Empresa::create([
            'id' => 12,
            'ruc' => '20601353874',
            'razon_social' => 'EMPRESA PRUEBAS SISTEMA',
            'cod_unidad' => '202020',
            'departamento' => 'JUNIN',
            'provincia' => 'HUANCAYO',
            'distrito' => 'CHILCA',
            'direccion' => 'Prolongacion Mariategui 800',
            'logo' => 'logos/logo-empresa-pruebas.jpg',
            'correo' => 'soluciones@cimark.pe',
            'web' => 'www.cimark.pe',
            'direcciones' =>'JUNÍN: Pj. Orellana Mza. l Lote. 44 Chilca - Huancayo LIMA: Calle Buenos Aires N° 231 (primera cuadra de Juan Fannig) - Miraflores - www.cimark.pe',
            'telefono' => '954000058',
            'estado' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
    }
}
