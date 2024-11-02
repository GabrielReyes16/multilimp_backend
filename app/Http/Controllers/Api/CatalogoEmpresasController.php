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
            'catalogos' => 'required|array',
            'catalogos.*.codigo' => 'required|string|max:255',
            'catalogos.*.id_empresa' => 'required|integer|exists:empresas,id',
        ]);

        //Crear cada catalogo
        $catalogos = [];
        foreach ($validatedData['catalogos'] as $catalogoData) {
            $catalogos[] = CatalogoEmpresa::create($catalogoData);
        }

        return response()->json($catalogos, 201);
    }

    // Actualizar un registro existente
    public function update(Request $request, $id_empresa)
    {
        $validatedData = $request->validate([
            'catalogos' => 'required|array',
            'catalogos.*.id' => 'required|integer|exists:catalogo_empresas,id',
            'catalogos.*.codigo' => 'string|max:255',
        ]);

        $updatedCatalogos = [];
        foreach ($validatedData['catalogos'] as $contactoData) {
            $contacto = CatalogoEmpresa::where('id', $contactoData['id'])
                        ->where('id_empresa', $id_empresa)
                        ->first();

            if ($contacto) {
                $contacto->update($contactoData);
                $updatedCatalogos[] = $contacto;
            }
        }
        if (empty($updatedCatalogos)) {
            return response()->json(['message' => 'No se encontraron catalogos para actualizar'], 404);
        }

        return response()->json($updatedCatalogos, 200);
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
