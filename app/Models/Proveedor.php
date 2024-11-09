<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = [
        'ruc',
        'razon_social',
        'departamento',
        'provincia',
        'distrito',
        'direccion',
        'monto',
        'estado',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $timestamps = true;

    public function contactos()
    {
        return $this -> hasMany(ContactoProveedor::class, 'id_proveedor');
    }

    public function bancos()
    {
        return $this -> hasMany(BancoProveedores::class, 'id_proveedor');
    }
}
