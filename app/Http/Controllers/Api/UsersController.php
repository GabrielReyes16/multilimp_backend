<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    // Obtener todos los usuarios
    public function index()
    {
        return User::with('role')->get(); // Incluir la relación de roles
    }

    // Crear un nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'nullable|exists:roles,id',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'foto' => 'nullable|string',
            'tabla' => 'nullable|string',
        ]);

        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    // Obtener un usuario específico
    public function show($id)
    {
        return User::with('role')->findOrFail($id); // Incluir la relación de roles
    }

    // Actualizar un usuario existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8',
            'role_id' => 'nullable|exists:roles,id',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'foto' => 'nullable|string',
            'tabla' => 'nullable|string',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }
}
