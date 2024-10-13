<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\ContactoTransporte;
class ContactoTransportesController extends Controller
{
    private const STRING_100 = 'nullable|string|max:100';
    private const NOT_FOUND = 'Contacto no encontrado';

    // Método para obtener todos los contactos de transporte
    public function index()
    {
        $contactos = ContactoTransporte::all();
        return response()->json($contactos);
    }

    // Método para crear un nuevo contacto de transporte
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'correo' => 'nullable|email|max:255',
            'cargo' => self::STRING_100,
            'id_cliente' => self::STRING_100,
            'estado' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $contacto = ContactoTransporte::create($request->all());
        return response()->json($contacto, 201);
    }

    // Método para obtener un contacto de transporte específico
    public function show($id)
    {
        $contacto = ContactoTransporte::find($id);
        if (!$contacto) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }
        return response()->json($contacto);
    }

    // Método para actualizar un contacto de transporte
    public function update(Request $request, $id)
    {
        $contacto = ContactoTransporte::find($id);
        if (!$contacto) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'correo' => 'nullable|email|max:255',
            'cargo' => self::STRING_100,
            'id_cliente' => self::STRING_100,
            'estado' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $contacto->update($request->all());
        return response()->json($contacto);
    }

    // Método para eliminar un contacto de transporte
    public function destroy($id)
    {
        $contacto = ContactoTransporte::find($id);
        if (!$contacto) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }

        $contacto->delete();
        return response()->json(['message' => 'Contacto eliminado exitosamente']);
    }
}
