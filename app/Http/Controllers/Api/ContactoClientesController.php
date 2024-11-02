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
            'contactos' => 'required|array',
            'contactos.*.nombre' => self::REQ_STRING_255,
            'contactos.*.telefono' => self::REQ_STRING_255,
            'contactos.*.correo' => 'required|string|email|max:255',
            'contactos.*.cargo' => self::REQ_STRING_255,
            'contactos.*.id_cliente' => 'required|integer|exists:clientes,id',
            'contactos.*.estado' => 'nullable|integer',
        ]);

        // Crear cada contacto
        $contactos = [];
        foreach ($validatedData['contactos'] as $contactoData) {
            $contactos[] = ContactoCliente::create($contactoData);
        }

        return response()->json($contactos, 201);
    }


    // Actualizar un registro existente
    public function update(Request $request, $id_cliente)
    {
        $validatedData = $request->validate([
            'contactos' => 'required|array',
            'contactos.*.id' => 'required|integer|exists:contacto_clientes,id',
            'contactos.*.nombre' => self::STRING_255,
            'contactos.*.telefono' => self::STRING_255,
            'contactos.*.correo' => 'string|email|max:255',
            'contactos.*.cargo' => self::STRING_255,
            'contactos.*.estado' => 'nullable|integer',
        ]);

        $updatedContactos = [];

        foreach ($validatedData['contactos'] as $contactoData) {
            $contacto = ContactoCliente::where('id', $contactoData['id'])
                        ->where('id_cliente', $id_cliente)
                        ->first();

            if ($contacto) {
                $contacto->update($contactoData);
                $updatedContactos[] = $contacto;
            }
        }

        if (empty($updatedContactos)) {
            return response()->json(['message' => 'No se encontraron contactos para actualizar'], 404);
        }

        return response()->json($updatedContactos, 200);
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
