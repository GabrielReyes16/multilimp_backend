<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermisoConfiguracion extends Model
{
    protected $table = 'permisos_configuraciones';
    protected $fillable = ['nombre'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_permiso_configuracion');
    }
}
