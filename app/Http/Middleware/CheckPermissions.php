<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermissions
{
    public function handle(Request $request, Closure $next)
{
    $user = Auth::user();

    // Cargar las relaciones necesarias
    $user->load('permisosConfiguracion', 'permisosProcesos');

    $routeName = $request->route()->getName();

    // Obtener los nombres de los permisos
    $configPermissions = $user->permisosConfiguracion->pluck('id')->toArray();
    $processPermissions = $user->permisosProcesos->pluck('id')->toArray();
    $allPermissions = array_merge($configPermissions, $processPermissions);

    // Agregar depuración
    \Log::info('Permisos del usuario:', [
        'configPermissions' => $configPermissions,
        'processPermissions' => $processPermissions,
        'allPermissions' => $allPermissions,
        'routeName' => $routeName,
    ]);

    // Verificar si el usuario tiene el permiso necesario
    if (!in_array($routeName, $allPermissions)) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    return $next($request);
}

}
