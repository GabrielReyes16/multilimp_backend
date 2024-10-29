<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactoProveedor extends Model
{
    use HasFactory;

    protected $table = 'contacto_proveedores';

    protected $fillable = [
        'nombre',
        'telefono',
        'correo',
        'cargo',
        'id_cliente',
        'estado',
    ];

    protected $hidden =[
        'id_proveedor'
    ];
}
