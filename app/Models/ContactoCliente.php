<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactoCliente extends Model
{
    use HasFactory;

    protected $table = 'contacto_clientes'; // Nombre de la tabla

    protected $fillable = [
        'nombre',
        'telefono',
        'correo',
        'cargo',
        'id_cliente',
        'estado',
        'created_at',
        'updated_at',
    ];
    protected $hidden =[
        'id_cliente',
    ];
}
