<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\PermisoProceso;
use App\Models\PermisoConfiguracion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserPermissionController extends Controller
{
    public function updatePermissions(Request $request, $userId)
    {
        // Validar que los permisos sean arrays de IDs
        $request->validate([
            'permisosProcesos' => 'array',
            'permisosProcesos.*' => 'integer|exists:permisos_procesos,id',
            'permisosConfiguracion' => 'array',
            'permisosConfiguracion.*' => 'integer|exists:permisos_configuraciones,id',
        ]);

        // Buscar el usuario
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        // Actualizar permisos de procesos
        if ($request->has('permisosProcesos')) {
            $user->permisosProcesos()->sync($request->input('permisosProcesos'));
        }

        // Actualizar permisos de configuración
        if ($request->has('permisosConfiguracion')) {
            $user->permisosConfiguracion()->sync($request->input('permisosConfiguracion'));
        }

        return response()->json([
            'message' => 'Permisos actualizados correctamente',
            'permisosProcesos' => $user->permisosProcesos()->get(['id', 'nombre']),
            'permisosConfiguracion' => $user->permisosConfiguracion()->get(['id', 'nombre']),
        ], Response::HTTP_OK);
    }
}
