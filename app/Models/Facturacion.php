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
public function refacturaciones()
    {
        return $this->hasMany(Refacturacion::class, 'id_facturacion');
    }
}
