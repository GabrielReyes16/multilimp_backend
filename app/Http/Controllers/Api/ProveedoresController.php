<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    //Constantes
    private const NULLABLE_STRING_255 =  'nullable|string|max:255';
    // Obtener todos los proveedores
    public function index()
    {
        $proveedores = Proveedor::with('contactos')->get();
        return response()->json($proveedores);
    }

    // Crear un nuevo proveedor
    public function store(Request $request)
    {
        $request->validate([
            'ruc' => 'required|string|max:255',
            'razon_social' => 'required|string|max:1000',
            'departamento' => self::NULLABLE_STRING_255,
            'provincia' => self::NULLABLE_STRING_255,
            'distrito' => self::NULLABLE_STRING_255,
            'direccion' => 'nullable|string|max:1000',
            'monto' => self::NULLABLE_STRING_255,
            'estado' => 'nullable|integer',
        ]);

        $proveedor = Proveedor::create($request->all());
        return response()->json($proveedor, 201);
    }

    // Obtener un proveedor específico
    public function show($id)
    {
        $proveeedor = Proveedor::with('contactos') -> find($id);

        if(!$proveeedor){
            return response()->json(['message' => 'Proveedor no encontrado'], 404);
        }
        return response() -> json($proveeedor, 201);
    }

    // Actualizar un proveedor existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'ruc' => 'required|string|max:255',
            'razon_social' => 'required|string|max:1000',
            'departamento' => self::NULLABLE_STRING_255,
            'provincia' => self::NULLABLE_STRING_255,
            'distrito' => self::NULLABLE_STRING_255,
            'direccion' => 'nullable|string|max:1000',
            'monto' => self::NULLABLE_STRING_255,
            'estado' => 'nullable|integer',
        ]);

        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($request->all());
        return response()->json($proveedor, 200);
    }

    // Eliminar un proveedor
    public function destroy(Proveedor $proveedor)
    {
        $proveedor -> estado = 0;
        $proveedor->save();

        return response()->json(['message' => 'Proveedor desactivado exitosamente']);
    }
}
