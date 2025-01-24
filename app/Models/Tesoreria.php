<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tesoreria extends Model
{
    use HasFactory;
    protected $table = "tesoreria";

    protected $fillable =
[       'fecha_pago',
        'banco',
        'descripcion',
        'total',
        'id_orden_pedido',
        'id_seguimiento',
        'estado'
];

protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
];

public $timestamps = true;

public function orden_pedido()
{
    return $this->belongsTo(OrdenPedido::class, 'id_orden_pedido');
}

public function seguimiento()
{
    return $this->belongsTo(Seguimiento::class, 'id_seguimiento');
}
}
