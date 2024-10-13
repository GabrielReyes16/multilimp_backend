<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenPedido extends Model
{
    use HasFactory;

    protected $table = 'orden_pedidos';

    protected $fillable = [
        'id_op',
        'id_empresa',
        'fecha_orden_pedido',
        'fecha_programacion',
        'tipo_envio',
        'id_proveedor',
        'contacto_proveedor',
        'nota_pedido',
        'fecha_recepcion',
        'tipo_pago',
        'nota_pago',
        'etiquetado',
        'embalaje',
        'observaciones',
        'total_proveedor',
        'id_transporte',
        'contacto_transporte',
        'cot_transporte',
        'flete',
        't_departamento',
        't_provincia',
        't_distrito',
        't_direccion',
        'transporte_nota',
        't_factura',
        't_grt',
        't_fecha_pago',
        'estado_op',
        'fecha_entrega',
        'retorno_mercaderia',
        'cargo_oea',
        'nota_op',
        'id_seguimiento',
    ];

    // Define the relationship with other models if needed
    public function seguimiento()
    {
        return $this->belongsTo(Seguimiento::class, 'id_seguimiento');
    }
}
