<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transporte; // Asegúrate de que el modelo esté correctamente importado
use Illuminate\Http\Request;

class TransportesController extends Controller
{
    //Constantes
    private const NULLABLE_STRING_255 =self::NULLABLE_STRING_255;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transportes = Transporte::with('contactos')->get();
        return response()->json($transportes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ruc' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'departamento' => self::NULLABLE_STRING_255,
            'provincia' => self::NULLABLE_STRING_255,
            'distrito' => self::NULLABLE_STRING_255,
            'direccion' => self::NULLABLE_STRING_255,
            'cobertura' => 'nullable|string|max:1000',
            'estado' => 'nullable|integer',
        ]);

        $transporte = Transporte::create($request->all()); // Crea un nuevo transporte
        return response()->json($transporte, 201); // Retorna el transporte creado
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transporte = Transporte::with('contactos') -> find($id);

        if(!$transporte){
            return response()->json(['message' => 'Transporte no encontrado'], 404);
        }
        return response() -> json($transporte, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transporte $transporte)
    {
        $request->validate([
            'ruc' => 'sometimes|required|string|max:255',
            'razon_social' => 'sometimes|required|string|max:255',
            'departamento' => self::NULLABLE_STRING_255,
            'provincia' => self::NULLABLE_STRING_255,
            'distrito' => self::NULLABLE_STRING_255,
            'direccion' => self::NULLABLE_STRING_255,
            'cobertura' => 'nullable|string|max:1000',
            'estado' => 'nullable|integer',
        ]);

        $transporte->update($request->all()); // Actualiza el transporte
        return response()->json($transporte, 200); // Retorna el transporte actualizado
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transporte $transporte)
    {
        $transporte->delete(); // Elimina el transporte
        return response()->json(null, 204); // Retorna respuesta vacía
    }
}
