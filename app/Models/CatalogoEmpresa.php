<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoEmpresa extends Model
{
    use HasFactory;

    protected $table = 'catalogo_empresas'; // Nombre de la tabla

    protected $fillable = [
        'codigo',
        'id_empresa',
        'created_at',
        'updated_at',
    ];
}
