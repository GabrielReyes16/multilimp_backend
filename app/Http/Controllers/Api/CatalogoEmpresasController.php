<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CatalogoEmpresa;
use Illuminate\Http\Request;

class CatalogoEmpresasController extends Controller
{
    //Constantes
    private const NOT_FOUND = self::STRING_255;
    // Obtener todos los registros de catalogo_empresas
    public function index()
    {
        $catalogos = CatalogoEmpresa::all();
        return response()->json($catalogos, 200);
    }

    // Obtener un registro específico por ID
    public function show($id)
    {
        $catalogo = CatalogoEmpresa::find($id);

        if (!$catalogo) {
            return response()->json(['message' =>self::NOT_FOUND], 404);
        }

        return response()->json($catalogo, 200);
    }

    // Crear un nuevo registro de catalogo_empresas
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'codigo' => 'required|string|max:255',
            'id_empresa' => 'required|integer',
        ]);

        $catalogo = CatalogoEmpresa::create($validatedData);

        return response()->json($catalogo, 201);
    }

    // Actualizar un registro existente
    public function update(Request $request, $id)
    {
        $catalogo = CatalogoEmpresa::find($id);

        if (!$catalogo) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }

        $validatedData = $request->validate([
            'codigo' => 'string|max:255',
            'id_empresa' => 'integer',
        ]);

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
