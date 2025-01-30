<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refacturacion extends Model
{
    use HasFactory;

    protected $table = "refacturaciones";

    protected $fillable =
    [
        'id_facturacion',
        'id_venta',
        'factura',
        'fecha_factura',
        'grr',
        'retencion',
        'detraccion',
        'forma_envio',
        'isActive'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $timestamps = true;

    public function facturacion()
    {
        return $this->belongsTo(Facturacion::class, 'id_facturacion');
    }
    public function venta()
    {
        return $this->belongsTo(Seguimiento::class, 'id_venta');
    }
}
