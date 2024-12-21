<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contra;
use Illuminate\Http\Request;

class ContrasController extends Controller
{
    //Constantes
    // private const NOT_FOUND = self::STRING_255;
    // Listar todas las contras
    public function index()
    {
        return response()->json(Contra::all());
    }

    // Mostrar una contra específica
    public function show($id)
    {
        $contra = Contra::find($id);
        if (!$contra) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }
        return response()->json($contra);
    }

    // Crear una nueva contra
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'contra' => 'required|string|max:255',
        ]);

        $contra = Contra::create($validatedData);
        return response()->json($contra, 201);
    }

    // Actualizar una contra existente
    public function update(Request $request, $id)
    {
        $contra = Contra::find($id);
        if (!$contra) {
            return response()->json(['message' =>  self::NOT_FOUND], 404);
        }

        $validatedData = $request->validate([
            'contra' => 'sometimes|required|string|max:255',
        ]);

        $contra->update($validatedData);
        return response()->json($contra);
    }

    // Eliminar una contra
    public function destroy($id)
    {
        $contra = Contra::find($id);
        if (!$contra) {
            return response()->json(['message' =>  self::NOT_FOUND], 404);
        }

        $contra->delete();
        return response()->json(['message' => 'Contra eliminada']);
    }
}
