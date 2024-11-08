<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\ContactoProveedor;

class ContactoProveedoresController extends Controller
{
    private const STRING_255 = 'string|max:255';
    private const NOT_FOUND = 'Contactos de Proveedor no encontrados';

    // Método para obtener todos los contactos de proveedores
    public function index()
    {
        $contactos = ContactoProveedor::all() ->groupBy('id_proveedor');
        return response()->json($contactos, 200);
    }

    // Método para obtener un contacto de proveedor específico
    public function show($id)
    {
        $contactos = ContactoProveedor::where('id_proveedor', $id)->get();

        if (!$contactos) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }
        return response()->json($contactos);
    }

    // Método para crear un nuevo contacto de proveedor
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => self::STRING_255,
            'telefono' => 'nullable|string|max:50',
            'correo' => self::STRING_255,
            'cargo' => 'nullable|string|max:100',
            'id_proveedor' => 'nullable|integer|exists:proveedores,id',
            'estado' => 'nullable|integer',
        ]);

        //Crear cada contacto
        $contacto = ContactoProveedor::create($validatedData);

        return response()->json($contacto, 201);
    }

    // Método para actualizar un contacto de proveedor
    public function update(Request $request, $id_proveedor)
    {
        $validatedData = $request -> validate([
            'id' => 'required|integer|exists:contacto_proveedores,id',
            'nombre' => self::STRING_255,
            'telefono' => 'nullable|string|max:50',
            'correo' => self::STRING_255,
            'cargo' => 'nullable|string|max:100',
            'estado' => 'nullable|integer',
        ]);

        $contacto = ContactoProveedor::where('id', $validatedData['id'])->where('id_proveedor', $id_proveedor)->first();

        if(!$contacto){
            return response()->json(['message' => self::NOT_FOUND], 404);
        }
        $contacto->update($validatedData);

        return response()->json($contacto, 200);

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
