<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'nombre',
        'apellido',
        'foto',
        'tabla',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Función para verificar si el usuario es administrador
    public function isAdmin()
    {
        return $this->rol === 'admin';
    }

    // Relación con permisosProcesos y permisosConfiguracion
    public function permisosProcesos()
    {
        return $this->belongsToMany(PermisoProceso::class, 'user_permiso_proceso');
    }

    public function permisosConfiguracion()
    {
        return $this->belongsToMany(PermisoConfiguracion::class, 'user_permiso_configuracion');
    }
}
