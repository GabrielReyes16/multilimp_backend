<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresas = Empresa::all();
        return response()->json($empresas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ruc' => 'nullable|string',
            'razon_social' => 'nullable|string',
            'cod_unidad' => 'nullable|string',
            'departamento' => 'nullable|string',
            'provincia' => 'nullable|string',
            'distrito' => 'nullable|string',
            'direccion' => 'nullable|string',
            'logo' => 'nullable|string',
            'correo' => 'nullable|email',
            'web' => 'nullable|string',
            'direcciones' => 'nullable|string',
            'telefono' => 'nullable|string',
            'estado' => 'nullable|integer',
        ]);

        $empresa = Empresa::create($validatedData);
        return response()->json($empresa, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return response()->json(['message' => 'Empresa not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($empresa, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return response()->json(['message' => 'Empresa not found'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'ruc' => 'nullable|string',
            'razon_social' => 'nullable|string',
            'cod_unidad' => 'nullable|string',
            'departamento' => 'nullable|string',
            'provincia' => 'nullable|string',
            'distrito' => 'nullable|string',
            'direccion' => 'nullable|string',
            'logo' => 'nullable|string',
            'correo' => 'nullable|email',
            'web' => 'nullable|string',
            'direcciones' => 'nullable|string',
            'telefono' => 'nullable|string',
            'estado' => 'nullable|integer',
        ]);

        $empresa->update($validatedData);
        return response()->json($empresa, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return response()->json(['message' => 'Empresa not found'], Response::HTTP_NOT_FOUND);
        }

        $empresa->delete();
        return response()->json(['message' => 'Empresa deleted successfully'], Response::HTTP_OK);
    }
}
