<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cotizacion',
        'id_empresa',
        'id_cliente',
        'id_contacto_cliente',
        'monto',
        'tipo_pago',
        'nota_pago',
        'nota_pedido',
        'c_direccion',
        'c_distrito',
        'c_provincia',
        'c_departamento',
        'c_referencia',
        'estado',
        'fecha_cotizacion',
        'fecha_entrega',
    ];
}
