<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CatalogoEmpresa;
use Illuminate\Http\Request;

class CatalogoEmpresasController extends Controller
{
    //Constantes
    private const NOT_FOUND = 'No encontrado';

    // Obtener todos los registros de catalogo_empresas
    public function index()
    {
        $catalogos = CatalogoEmpresa::all()->groupBy('id_empresa');
        return response()->json($catalogos, 200);
    }

    // Obtener un registro específico por ID
    public function show($id)
    {
        $catalogo = CatalogoEmpresa::where('id_empresa', $id)->get();

        if (!$catalogo) {
            return response()->json(['message' =>self::NOT_FOUND], 404);
        }

        return response()->json($catalogo, 200);
    }

    // Crear un nuevo registro de catalogo_empresas
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'codigo' => 'nullable|string|max:255',
            'id_empresa' => 'required|integer|exists:empresas,id',
        ]);

        //Crear  catalogo
        $catalogo = CatalogoEmpresa::create($validatedData);
        return response()->json($catalogo, 201);
    }

    // Actualizar un registro existente
    public function update(Request $request, $id_empresa)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:catalogo_empresas,id',
            'codigo' => 'string|max:255',
        ]);

        $catalogo = CatalogoEmpresa::where('id', $validatedData['id']) ->where('id_empresa', $id_empresa)-> first();

        if (!$catalogo) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }
        $catalogo->update($validatedData);

        return response()->json($catalogo, 200);
    }

    // Eliminar un registro
    public function destroy($id)
    {
        $catalogo = CatalogoEmpresa::find($id);

        if (!$catalogo) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }

        $catalogo->delete();

        return response()->json(['message' => 'CatalogoEmpresa eliminado'], 200);
    }
}
