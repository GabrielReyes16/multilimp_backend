<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactoCliente;
use Illuminate\Http\Request;

class ContactoClientesController extends Controller
{
    // Obtener todos los registros de contacto_clientes
    public function index()
    {
        $contactos = ContactoCliente::all();
        return response()->json($contactos, 200);
    }

    // Obtener un registro específico por ID
    public function show($id)
    {
        $contacto = ContactoCliente::find($id);

        if (!$contacto) {
            return response()->json(['message' => 'ContactoCliente no encontrado'], 404);
        }

        return response()->json($contacto, 200);
    }

    // Crear un nuevo registro de contacto_clientes
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255',
            'cargo' => 'required|string|max:255',
            'id_cliente' => 'required|string|max:255',
            'estado' => 'nullable|integer',
        ]);

        $contacto = ContactoCliente::create($validatedData);

        return response()->json($contacto, 201);
    }

    // Actualizar un registro existente
    public function update(Request $request, $id)
    {
        $contacto = ContactoCliente::find($id);

        if (!$contacto) {
            return response()->json(['message' => 'ContactoCliente no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'nombre' => 'string|max:255',
            'telefono' => 'string|max:255',
            'correo' => 'string|email|max:255',
            'cargo' => 'string|max:255',
            'id_cliente' => 'string|max:255',
            'estado' => 'nullable|integer',
        ]);

        $contacto->update($validatedData);

        return response()->json($contacto, 200);
    }

    // Eliminar un registro
    public function destroy($id)
    {
        $contacto = ContactoCliente::find($id);

        if (!$contacto) {
            return response()->json(['message' => 'ContactoCliente no encontrado'], 404);
        }

        $contacto->delete();

        return response()->json(['message' => 'ContactoCliente eliminado'], 200);
    }
}
