<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    // Obtener todos los proveedores
    public function index()
    {
        return Proveedor::all();
    }

    // Crear un nuevo proveedor
    public function store(Request $request)
    {
        $request->validate([
            'ruc' => 'required|string|max:255',
            'razon_social' => 'required|string|max:1000',
            'departamento' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'distrito' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:1000',
            'monto' => 'nullable|string|max:255',
            'estado' => 'nullable|integer',
        ]);

        $proveedor = Proveedor::create($request->all());
        return response()->json($proveedor, 201);
    }

    // Obtener un proveedor específico
    public function show($id)
    {
        return Proveedor::findOrFail($id);
    }

    // Actualizar un proveedor existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'ruc' => 'required|string|max:255',
            'razon_social' => 'required|string|max:1000',
            'departamento' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'distrito' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:1000',
            'monto' => 'nullable|string|max:255',
            'estado' => 'nullable|integer',
        ]);

        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($request->all());
        return response()->json($proveedor, 200);
    }

    // Eliminar un proveedor
    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();
        return response()->json(null, 204);
    }
}
