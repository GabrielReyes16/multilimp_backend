<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    // Tabla asociada
    protected $table = 'empresas';

    // Clave primaria
    protected $primaryKey = 'id';

    // Habilitar auto-incremento
    public $incrementing = true;

    // Tipo de la clave primaria
    protected $keyType = 'int';

    // Habilitar timestamps
    public $timestamps = true;

    // Asignación masiva
    protected $fillable = [
        'ruc',
        'razon_social',
        'cod_unidad',
        'departamento',
        'provincia',
        'distrito',
        'direccion',
        'logo',
        'correo',
        'web',
        'direcciones',
        'telefono',
        'estado',
    ];

    // Cast de campos
    protected $casts = [
        'estado' => 'integer',
    ];

    // Setter para 'direcciones'
    public function setDireccionesAttribute($value)
    {
        $this->attributes['direcciones'] = $value;
    }
}
