<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactoTransporte extends Model
{
    use HasFactory;

    protected $table = 'contacto_transportes';

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

    public $timestamps = true; // Activar timestamps si se usa 'created_at' y 'updated_at'
}
