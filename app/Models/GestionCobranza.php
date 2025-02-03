<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GestionCobranza extends Model
{
    use HasFactory;
    protected $table = "gestion_cobranzas";

    protected $fillable =
    [
        'id_seguimiento',
        'historial',
        'descripcion',
        'fecha_gestion',
        'documento_url',
        'estado',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $timestamps = true;

    public function venta()
    {
        return $this->belongsTo(Seguimiento::class, 'id_seguimiento');
    }
}
