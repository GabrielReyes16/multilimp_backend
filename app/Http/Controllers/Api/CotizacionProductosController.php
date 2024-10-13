<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\CotizacionProducto;

class CotizacionProductosController extends Controller
{
    private const NOT_FOUND = 'Producto no encontrado';
    private const NULL_STRING255 = 'nullable|string|max:255';
    private const REQ_STRING255 = 'required|string|max:255';
    /**
     * Muestra una lista de productos de cotización.
     */
    public function index()
    {
        $productos = CotizacionProducto::all();
        return response()->json($productos);
    }

    /**
     * Almacena un nuevo producto en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación de los datos y verificación de que la cotización exista
        $validator = Validator::make($request->all(), [
            'codigo' => self::REQ_STRING255,
            'descripcion' => 'nullable|string|max:10000',
            'medida' => self::NULL_STRING255,
            'p_cliente' => self::REQ_STRING255,
            'cantidad' => self::REQ_STRING255,
            'precio_unitario' => self::REQ_STRING255,
            'total' => self::REQ_STRING255,
            'id_cotizacion' => 'required|exists:cotizaciones,id', // Validación del ID de cotización
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Crear nuevo producto
        $producto = CotizacionProducto::create($request->all());

        return response()->json($producto, 201);
    }

    /**
     * Muestra un producto específico basado en el ID.
     */
    public function show($id)
    {
        $producto = CotizacionProducto::find($id);

        if (!$producto) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }

        return response()->json($producto);
    }

    /**
     * Actualiza los datos de un producto en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // Verificar si el producto existe
        $producto = CotizacionProducto::find($id);
        if (!$producto) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }

        // Validar los datos y verificar que la cotización exista
        $validator = Validator::make($request->all(), [
            'codigo' => self::NULL_STRING255,
            'descripcion' => 'nullable|string|max:10000',
            'medida' => self::NULL_STRING255,
            'p_cliente' => self::NULL_STRING255,
            'cantidad' => self::NULL_STRING255,
            'precio_unitario' => self::NULL_STRING255,
            'total' => self::NULL_STRING255,
            'id_cotizacion' => 'required|exists:cotizaciones,id', // Validación del ID de cotización
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Actualizar el producto
        $producto->update($request->all());

        return response()->json($producto);
    }

    /**
     * Elimina un producto de cotización de la base de datos.
     */
    public function destroy($id)
    {
        $producto = CotizacionProducto::find($id);

        if (!$producto) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }

        $producto->delete();

        return response()->json(['message' => 'Producto eliminado exitosamente']);
    }
}
