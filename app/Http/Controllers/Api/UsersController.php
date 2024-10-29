<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PermisoConfiguracion;
use App\Models\PermisoProceso;


class UsersController extends Controller
{
    private const PROCESS_ID_NAME = 'permisosProcesos:id,nombre'; //Traer el ID y el nombre de los permisos de procesos
    private const CONFIG_ID_NAME = 'permisosConfiguracion:id,nombre'; //Traer el IDy el nombbre de los permisos de las configuraciones
    private const STRING_NULL = 'string|nullable'; //Permite strings nulos

    public function index()
    {
        // Obtener todos los usuarios con sus permisos
        $users = User::with([ self::PROCESS_ID_NAME, self::CONFIG_ID_NAME])->get();

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

        $user->permisosProcesos()->sync($permisosProcesosIds);

        // Asignación de permisos de configuración
        $permisosConfiguracionIds = PermisoConfiguracion::whereIn('nombre', $request->permisosConfiguracion)->pluck('id');


        $user->permisosConfiguracion()->sync($permisosConfiguracionIds);

        // Cargar los permisos para la respuesta
        $user->load([self::PROCESS_ID_NAME, self::CONFIG_ID_NAME]);

        // Devolver la respuesta JSON con los permisos otorgados
        return response()->json([
            'user' => $user,
        ]);
    }
    public function show($id)
    {
        // Intentar obtener el usuario con sus relaciones
        $user = User::with([self::PROCESS_ID_NAME, self::CONFIG_ID_NAME])->find($id);

        // Verificar si el usuario existe
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Formatear la respuesta para incluir solo los campos necesarios
        $userData = [
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

        return response()->json($userData, 200);

    }

    //ACTULIZAR UN USUARIO
    public function update(Request $request, $id)
    {
        // Intentar obtener el usuario
        $user = User::find($id);

        // Verificar si el usuario existe
        if (!$user) {
            return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        // Validar los datos del request (solo los campos del usuario)
        $validatedData = $request->validate([
            'username' => 'string|unique:users,username,' . $user->id,
            'email' => 'string|email|unique:users,email,' . $user->id,
            'password' => 'string|nullable|min:6',
            'nombre' => 'nullable|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'foto' => 'nullable|string|max:255',
            'rol' => 'in:admin,user',
        ]);

        // Actualizar la información del usuario
        $user->username = $validatedData['username'] ?? $user->username;
        $user->email = $validatedData['email'] ?? $user->email;
        if (isset($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }
        $user->nombre = $validatedData['nombre'] ?? $user->nombre;
        $user->apellido = $validatedData['apellido'] ?? $user->apellido;
        $user->foto = $validatedData['foto'] ?? $user->foto;
        $user->rol = $validatedData['rol'] ?? $user->rol;
        $user->save();

        // Formatear la respuesta para incluir solo los campos actualizados del usuario
        $userData = [
            'username' => $user->username,
            'email' => $user->email,
            'nombre' => $user->nombre,
            'apellido' => $user->apellido,
            'foto' => $user->foto,
            'rol' => $user->rol,
        ];

        return response()->json($userData, Response::HTTP_OK);
    }
}
