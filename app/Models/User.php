<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
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
        'rol',
        'tabla',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Métodos requeridos por JWTSubject
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // Función para verificar si el usuario es administrador
    public function isAdmin()
    {
        return $this->rol === 'admin';
    }

    // Relación con permisos de proceso
    public function permisosProcesos()
    {
        return $this->belongsToMany(PermisoProceso::class, 'user_permiso_proceso', 'user_id', 'permiso_proceso_id');
    }

    // Relación con permisos de configuración
    public function permisosConfiguracion()
    {
        return $this->belongsToMany(PermisoConfiguracion::class, 'user_permiso_configuracion', 'user_id', 'permiso_configuracion_id');
    }
}
