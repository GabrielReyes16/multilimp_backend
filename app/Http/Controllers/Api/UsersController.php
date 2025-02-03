<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PermisoConfiguracion;
use App\Models\PermisoProceso;

class UsersController extends Controller
{
    private const PROCESS_ID_NAME = 'permisosProcesos:id,nombre';
    private const CONFIG_ID_NAME = 'permisosConfiguracion:id,nombre';
    private const NULLABLE_STRING_255 = 'nullable|string|max:255';
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
            'username' => $request->username ?? null,
            'email' => (string)$request->email ?? null,
            'password' => $request->password ? bcrypt($request->password) : null,
            'nombre' => $request->nombre ?? null,
            'apellido' => $request->apellido ?? null,
            'foto' => $request->fotoPerfil ?? null,
            'rol' => $request->rol ?? null,
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
            'username' => $user->username ?? null,
            'email' => (string)$user->email ?? null,
            'nombre' => $user->nombre ?? null,
            'apellido' => $user->apellido ?? null,
            'foto' => $user->foto ?? null,
            'rol' => $user->rol ?? null,
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
            return response()->json(['message' => 'User not found'], 404);
        }

        // Validar los datos del request (solo los campos del usuario)
        $validatedData = $request->validate([
            'username' => 'string|unique:users,username,' . $user->id,
            'email' => self::NULLABLE_STRING_255 . $user->id,
            'password' => 'string|nullable|min:6',
            'nombre' => self::NULLABLE_STRING_255,
            'apellido' => self::NULLABLE_STRING_255,
            'foto' => self::NULLABLE_STRING_255,
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

        return response()->json($userData, 200);
    }

    // ========================================================
    // POST /users/{id}/upload-photo
    public function uploadPhoto(Request $request, $id) {
        $request->validate([
            'file' => 'required|image|max:4096|mimes:jpeg,png,jpg',
        ]);
    
        $user = User::findOrFail($id);
    
        // Eliminar imagen anterior
        if ($user->foto) {
            $oldPath = str_replace(env('APP_URL') . '/storage/', '', $user->foto);
            Storage::disk('public')->delete($oldPath);
        }
    
        // Guardar imagen
        $path = $request->file('file')->store('users', 'public');
    
        // Construir URL manualmente
        $backendUrl = env('APP_URL'); // Ej: http://localhost:8000
        $absoluteUrl = $backendUrl . '/storage/' . $path;
    
        // Actualizar base de datos
        $user->foto = $absoluteUrl;
        $user->save();
    
        return response()->json([
            'foto' => $absoluteUrl
        ]);
    }
}