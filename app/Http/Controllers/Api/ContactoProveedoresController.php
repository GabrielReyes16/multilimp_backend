<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\ContactoProveedor;

class ContactoProveedoresController extends Controller
{
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
            'contactos' => 'required|array',
            'contactos.*.nombre' => 'nullable|string|max:255',
            'contactos.*.telefono' => 'nullable|string|max:50',
            'contactos.*.correo' => 'nullable|email|max:255',
            'contactos.*.cargo' => 'nullable|string|max:100',
            'contactos.*.id_proveedor' => 'nullable|integer|exists:proveedores,id',
            'contactos.*.estado' => 'nullable|integer',
        ]);

        //Crear cada contacto

        $contactos = [];
        foreach ($validatedData['contactos'] as $contactoData) {
            $contactos[] = ContactoProveedor::create($contactoData);
        }

        return response()->json($contactos, 201);
    }

    // Método para actualizar un contacto de proveedor
    public function update(Request $request, $id_proveedor)
    {
        $validatedData = $request->validate([
            'contactos' => 'required|array',
            'contactos.*.id' => 'required|integer|exists:contacto_proveedores,id',
            'contactos.*.nombre' => 'nullable|string|max:255',
            'contactos.*.telefono' => 'nullable|string|max:50',
            'contactos.*.correo' => 'nullable|email|max:255',
            'contactos.*.cargo' => 'nullable|string|max:100',
            'contactos.*.estado' => 'nullable|integer',
        ]);
        $updatedContactos = [];

        foreach ($validatedData['contactos'] as $contactoData) {
            $contacto = ContactoProveedor::where('id', $contactoData['id'])
                        ->where('id_proveedor', $id_proveedor)
                        ->first();
            if (!$contacto) {
                return response()->json(['message' => self::NOT_FOUND], 404);
            }
            if ($contacto)
            {
                $contacto->update($contactoData);
                $updatedContactos[] = $contacto;
        }
        }
        if (empty($updatedContactos)) {
            return response()->json(['message' => 'No se encontraron contactos para actualizar'], 404);
        }
        return response(' Actualizado correctamente')->json($updatedContactos, 200);

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
