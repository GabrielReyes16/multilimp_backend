<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\OpProducto;

class OpProductoController extends Controller
{
    private const STRING_100 = 'nullable|string|max:100';
    private const NUMERIC = 'nullable|numeric';
    private const NOT_FOUND = 'Producto no encontrado';
    // Método para obtener todos los productos
    public function index()
    {
        $productos = OpProducto::all();
        return response()->json($productos);
    }

    // Método para crear un nuevo producto
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codigo' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'medida' => self::STRING_100,
            'p_cliente' => self::STRING_100,
            'almacen' => self::STRING_100,
            'cantidad' => 'nullable|string|max:50',
            'precio_unitario' => self::NUMERIC,
            'total' => self::NUMERIC,
            'id_orden_pedido' => self::STRING_100,
            'id_seguimiento' => self::STRING_100,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $producto = OpProducto::create($request->all());
        return response()->json($producto, 201);
    }

    // Método para obtener un producto específico
    public function show($id)
    {
        $producto = OpProducto::find($id);
        if (!$producto) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }
        return response()->json($producto);
    }

    // Método para actualizar un producto
    public function update(Request $request, $id)
    {
        $producto = OpProducto::find($id);
        if (!$producto) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }

        $validator = Validator::make($request->all(), [
            'codigo' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'medida' => self::STRING_100,
            'p_cliente' => self::STRING_100,
            'almacen' => self::STRING_100,
            'cantidad' => 'nullable|string|max:50',
            'precio_unitario' => self::NUMERIC,
            'total' => self::NUMERIC,
            'id_orden_pedido' => self::STRING_100,
            'id_seguimiento' => self::STRING_100,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $producto->update($request->all());
        return response()->json($producto);
    }

    // Método para eliminar un producto
    public function destroy($id)
    {
        $producto = OpProducto::find($id);
        if (!$producto) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }

        $producto->delete();
        return response()->json(['message' => 'Producto eliminado exitosamente']);
    }
}
