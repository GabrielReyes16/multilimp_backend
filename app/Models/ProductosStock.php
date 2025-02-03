<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosStock extends Model
{
    use HasFactory;
    protected $table = "producto_stock";

    protected $fillable =
    [
        'codigo',
        'marca',
        'descripcion',
        'categoria',
        'stock',
        'almacen',
        'foto',
        'isActive',

    ];

    protected $casts= [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $timestamps = true;

}
