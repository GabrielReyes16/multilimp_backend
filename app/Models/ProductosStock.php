<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosStock extends Model
{
    use HasFactory;
    protected $table = "productos_stock";

    protected $fields =
    [
        'codigo',
        'marca',
        'descripcion',
        'categoria',
        'stock',
        'isActive',

    ];

    protected $casts= [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $timestamps = true;

}
