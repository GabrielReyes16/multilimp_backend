<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transporte extends Model
{
    use HasFactory;

    protected $table = 'transportes';

    protected $fillable = [
        'ruc',
        'razon_social',
        'departamento',
        'provincia',
        'distrito',
        'direccion',
        'cobertura',
        'estado',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $timestamps = true;

    public function contactos()
    {
        return $this->hasMany(ContactoTransporte::class, 'id_transporte');
    }
}
