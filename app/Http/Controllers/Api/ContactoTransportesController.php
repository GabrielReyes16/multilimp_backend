<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\ContactoTransporte;
class ContactoTransportesController extends Controller
{
    private const STRING_255 = 'string|max:255';
    private const NOT_FOUND = 'Contacto no encontrado';
    private const REQ_STRING_255 = 'required|string|max:255';

    // Método para obtener todos los contactos de transporte
    public function index()
    {
        $contactos = ContactoTransporte::all()->groupBy('id_transporte');
        return response()->json($contactos);
    }

        // Método para obtener un contacto de transporte específico
        public function show($id)
        {
            // Obtener todos los contactos que pertenecen al id_cliente especificado
            $contactos = ContactoTransporte::where('id_transporte', $id)->get();

            if ($contactos->isEmpty()) {
                return response()->json(['message' => 'Contactos de Transporte no encontrados o inexistentes'], 404);
            }

            return response()->json($contactos, 200);
        }


    // Método para crear un nuevo contacto de transporte
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'contactos' => 'required|array',
            'contactos.*.nombre' => self::REQ_STRING_255,
            'contactos.*.telefono' => self::REQ_STRING_255,
            'contactos.*.correo' => 'required|string|email|max:255',
            'contactos.*.cargo' => self::REQ_STRING_255,
            'contactos.*.id_transporte' => 'required|integer|exists:transportes,id',
            'contactos.*.estado' => 'nullable|integer',
        ]);

        // Crear cada contacto
        $contactos = [];
        foreach ($validatedData['contactos'] as $contactoData) {
            $contactos[] = ContactoTransporte::create($contactoData);
        }

        return response()->json($contactos, 201);
    }


    // Método para actualizar un contacto de transporte
    public function update(Request $request, $id_transporte)
    {
        $validatedData = $request->validate([
            'contactos' => 'required|array',
            'contactos.*.id' => 'required|integer|exists:contacto_transportes,id',
            'contactos.*.nombre' => self::STRING_255,
            'contactos.*.telefono' => self::STRING_255,
            'contactos.*.correo' => 'string|email|max:255',
            'contactos.*.cargo' => self::STRING_255,
            'contactos.*.estado' => 'nullable|integer',
        ]);

        $updatedContactos = [];

        foreach ($validatedData['contactos'] as $contactoData) {
            $contacto = ContactoTransporte::where('id', $contactoData['id'])
                        ->where('id_transporte', $id_transporte)
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
