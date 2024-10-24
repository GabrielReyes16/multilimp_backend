<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PermisoConfiguracion;
use App\Models\PermisoProceso;

class UsersController extends Controller
{

    public function index()
    {
        // Obtener todos los usuarios con sus permisos
        $users = User::with(['permisosProcesos:id,nombre', 'permisosConfiguracion:id,nombre'])->get();

        // Transformar la colección para incluir solo los campos necesarios
        $users = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'nombre' => $user->nombre,
                'apellido' => $user->apellido,
                'foto' => $user->foto,
                'rol' => $user->rol,
                'permisosProcesos' => $user->permisosProcesos->map(function ($permiso) {
                    return [
                        'id' => $permiso->id,
                        'nombre' => $permiso->nombre,
                    ];
                }),
                'permisosConfiguracion' => $user->permisosConfiguracion->map(function ($permiso) {
                    return [
                        'id' => $permiso->id,
                        'nombre' => $permiso->nombre,
                    ];
                }),
            ];
        });

        // Retornar la respuesta en formato JSON
        return response()->json($users);
    }


    public function store(Request $request)
    {
        // Validación del request
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'foto' => $request->fotoPerfil,
            'rol' => $request->rol,
        ]);

        // Asignación de permisos de procesos
        $permisosProcesosIds = PermisoProceso::whereIn('nombre', $request->permisosProcesos)->pluck('id');

        $user->permisosProcesos()->sync($permisosProcesosIds); // Asegúrate de que sean IDs

        // Asignación de permisos de configuración
        $permisosConfiguracionIds = PermisoConfiguracion::whereIn('nombre', $request->permisosConfiguracion)->pluck('id');


        $user->permisosConfiguracion()->sync($permisosConfiguracionIds); // Asegúrate de que sean IDs

        // Cargar los permisos para la respuesta
        $user->load(['permisosProcesos:id,nombre', 'permisosConfiguracion:id,nombre']);

        // Devolver la respuesta JSON con los permisos otorgados
        return response()->json([
            'user' => $user,
        ]);
    }
}
