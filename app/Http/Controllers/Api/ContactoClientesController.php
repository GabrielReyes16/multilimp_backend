<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactoCliente;
use Illuminate\Http\Request;

class ContactoClientesController extends Controller
{
    //Constantes
    private const REQ_STRING_255 = 'required|string|max:255';
    private const STRING_255 = 'string|max:255';
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
            return response()->json(['message' => 'Contacto de Cliente no encontrado'], 404);
        }

        return response()->json($contacto, 200);
    }

    // Crear un nuevo registro de contacto_clientes
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => self::REQ_STRING_255,
            'telefono' => self::REQ_STRING_255,
            'correo' => 'required|string|email|max:255',
            'cargo' => self::REQ_STRING_255,
            'id_cliente' => self::REQ_STRING_255,
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
            'nombre' => self::STRING_255,
            'telefono' => self::STRING_255,
            'correo' => 'string|email|max:255',
            'cargo' => self::STRING_255,
            'id_cliente' => self::STRING_255,
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
