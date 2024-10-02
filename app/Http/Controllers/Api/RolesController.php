<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    // Obtener todos los roles
    public function index()
    {
        return Role::all();
    }

    // Crear un nuevo rol
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $role = Role::create($request->all());
        return response()->json($role, 201);
    }

    // Obtener un rol específico
    public function show($id)
    {
        return Role::findOrFail($id);
    }

    // Actualizar un rol existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $role = Role::findOrFail($id);
        $role->update($request->all());
        return response()->json($role, 200);
    }

    // Eliminar un rol
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return response()->json(null, 204);
    }
}
