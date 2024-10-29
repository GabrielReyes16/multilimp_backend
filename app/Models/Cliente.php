<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Tabla asociada
    protected $table = 'clientes';

    // Clave primaria
    protected $primaryKey = 'id';

    // Deshabilitar los timestamps si no se utilizan las columnas created_at y updated_at
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
        'estado'
    ];

    // Si el modelo no tiene auto-increment en el ID, debes desactivar la propiedad $incrementing
    public $incrementing = true;

    // Si la clave primaria no es un entero, deberías especificar su tipo
    protected $keyType = 'int';

    public function contactos()
    {
        return $this->hasMany(ContactoCliente::class, 'id_cliente');
    }
}
