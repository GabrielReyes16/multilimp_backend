<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contra extends Model
{
    use HasFactory;

    protected $table = 'contras'; // Nombre de la tabla

    protected $fillable = [
        'contra',
        'created_at',
        'updated_at'
    ];
}
