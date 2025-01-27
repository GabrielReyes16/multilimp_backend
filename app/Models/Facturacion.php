<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturacion extends Model
{
    use HasFactory;
    protected $table = "facturaciones";

    protected $fillable =
    [
        'id_venta',
        'factura',
        'fecha_factura',
        'grr',
        'retencion',
        'detraccion',
        'forma_envio',
        're_factura',
        're_fecha_factura',
        're_grr',
        're_detraccion',
        're_retencion',
        're_forma_envio',
        'isActive'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $timestamps = true;

    public function venta()
    {
        return $this->belongsTo(Seguimiento::class, 'id_venta');
    }
}
