<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BancoProveedores extends Model
{
    use HasFactory;

    protected $table = 'banco_proveedores';

    protected $fillable =[
        'id_proveedor',
        'numero_cuenta',
        'nombre_banco',
        'estado',
        'created_at',
        'updated_at'
    ];

}
