<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactoCliente;
use Illuminate\Http\Request;

class ContactoClientesController extends Controller
{
    //Constantes
    private const STRING_255 = 'string|max:255';
    public function index()
    {
        // Obtener todos los contactos y agruparlos por 'id_cliente'
        $contactos = ContactoCliente::all()->groupBy('id_cliente');

        return response()->json($contactos, 200);
    }


    public function show($id)
    {
        // Obtener todos los contactos que pertenecen al id_cliente especificado
        $contactos = ContactoCliente::where('id_cliente', $id)->get();

        if ($contactos->isEmpty()) {
            return response()->json(['message' => 'Contactos de Cliente no encontrados'], 404);
        }

        return response()->json($contactos, 200);
    }


    // Crear un nuevo registro de contacto_clientes
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => self::STRING_255,
            'telefono' => self::STRING_255,
            'correo' => self::STRING_255,
            'cargo' => self::STRING_255,
            'id_cliente' => 'required|integer|exists:clientes,id',
            'estado' => 'nullable|integer',
        ]);

        $contacto = ContactoCliente::create($validatedData);

        return response()->json($contacto, 201);
    }


    // Actualizar un registro existente
    public function update(Request $request, $id_cliente)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:contacto_clientes,id',
            'nombre' => self::STRING_255,
            'telefono' => self::STRING_255,
            'correo' => self::STRING_255,
            'cargo' => self::STRING_255,
            'estado' => 'nullable|integer',
        ]);

        $contacto = ContactoCliente::where('id', $validatedData['id'])
                        ->where('id_cliente', $id_cliente)
                        ->first();

        if (!$contacto) {
            return response()->json(['message' => 'No se encontró el contacto para actualizar'], 404);
        }

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
