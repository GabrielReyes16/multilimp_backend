<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BancoProveedores;

class BancoProveedoresController extends Controller
{
    public function index()
    {
        $bancos = BancoProveedores::all()->groupBy('id_proveedor');

        return response()->json( $bancos , 200);
    }

    public function show($id)
    {
        $banco = BancoProveedores::where('id_proveedor', $id)->get();

        if (!$banco) {
            return response()->json(['message' => 'Banco not found'], 404);
        }

        return response()->json($banco, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_proveedor' => 'required|integer|exists:proveedores,id',
            'numero_cuenta' => 'nullable|string|max:255',
            'nombre_banco' => 'nullable|string|max:255',
        ]);

        $banco = BancoProveedores::create($validatedData);

        return response()->json($banco, 201);
    }

    public function update(Request $request, $id_proveedor)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:bancos_proveedores,id',
            'numero_cuenta' => 'string|max:255',
            'nombre_banco' => 'string|max:255',
        ]);

        $banco = BancoProveedores::where('id', $validatedData['id'])
            ->where('id_proveedor', $id_proveedor)
            ->first();

        if (!$banco) {
            return response()->json(['message' => 'Banco not found'], 404);
        }

        $banco->update($validatedData);

        return response()->json($banco, 200);
    }

    public function destroy(BancoProveedores $banco)
    {
        $banco -> estado = 0;
        $banco -> save();

        return response()->json(['message' => 'Banco eliminado'], 200);
    }
}
