<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpProducto extends Model
{
    use HasFactory;

    protected $table = 'op_productos';

    protected $fillable = [
        'codigo',
        'descripcion',
        'medida',
        'p_cliente',
        'almacen',
        'cantidad',
        'precio_unitario',
        'total',
        'id_orden_pedido',
        'id_seguimiento',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
