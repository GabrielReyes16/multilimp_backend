<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionProducto extends Model
{
    use HasFactory;

    protected $table = 'cotizacion_productos';

    protected $fillable = [
        'codigo',
        'descripcion',
        'medida',
        'p_cliente',
        'cantidad',
        'precio_unitario',
        'total',
        'id_cotizacion',
    ];
}
