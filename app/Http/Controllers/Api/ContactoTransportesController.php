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
            'nombre' => self::REQ_STRING_255,
            'telefono' => self::REQ_STRING_255,
            'correo' => 'required|string|email|max:255',
            'cargo' => self::REQ_STRING_255,
            'id_transporte' => 'required|integer|exists:transportes,id',
            'estado' => 'nullable|integer',
        ]);

        $contacto = ContactoTransporte::create($validatedData);


        return response()->json($contacto, 201);
    }


    // Método para actualizar un contacto de transporte
    public function update(Request $request, $id_transporte)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:contacto_transportes,id',
            'nombre' => self::STRING_255,
            'telefono' => self::STRING_255,
            'correo' => 'string|email|max:255',
            'cargo' => self::STRING_255,
            'estado' => 'nullable|integer',
        ]);

       $contacto = ContactoTransporte::where('id', $validatedData['id'])->where('id_transporte', $id_transporte)->first();

       if(!$contacto){
        return response()->json(['message' => self::NOT_FOUND], 404);
       }
       $contacto->update($validatedData);

        return response()->json($contacto, 200);
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
