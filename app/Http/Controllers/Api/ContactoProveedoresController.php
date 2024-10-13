<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\ContactoProveedor;

class ContactoProveedoresController extends Controller
{
    private const NOT_FOUND = 'Contacto no encontrado';
    // Método para obtener todos los contactos de proveedores
    public function index()
    {
        $contactos = ContactoProveedor::all();
        return response()->json($contactos);
    }

    // Método para crear un nuevo contacto de proveedor
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'correo' => 'nullable|email|max:255',
            'cargo' => 'nullable|string|max:100',
            'id_cliente' => 'nullable|integer|exists:clientes,id',
            'estado' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $contacto = ContactoProveedor::create($request->all());
        return response()->json($contacto, 201);
    }

    // Método para obtener un contacto de proveedor específico
    public function show($id)
    {
        $contacto = ContactoProveedor::find($id);
        if (!$contacto) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }
        return response()->json($contacto);
    }

    // Método para actualizar un contacto de proveedor
    public function update(Request $request, $id)
    {
        $contacto = ContactoProveedor::find($id);
        if (!$contacto) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'correo' => 'nullable|email|max:255',
            'cargo' => 'nullable|string|max:100',
            'id_cliente' => 'nullable|integer|exists:clientes,id',
            'estado' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $contacto->update($request->all());
        return response()->json($contacto);
    }

    // Método para eliminar un contacto de proveedor
    public function destroy($id)
    {
        $contacto = ContactoProveedor::find($id);
        if (!$contacto) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }

        $contacto->delete();
        return response()->json(['message' => 'Contacto eliminado exitosamente']);
    }
}
