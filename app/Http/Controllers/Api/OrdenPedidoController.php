<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\OrdenPedido;

class OrdenPedidoController extends Controller
{
    private const NOT_FOUND = 'Orden de pedido no encontrada';
    private const NULL_INT = 'nullable|integer';
    private const NULL_DATE = 'nullable|date';
    private const NULL_STRING100 = 'nullable|string|max:100';
    private const NULL_STRING1000 = 'nullable|string|max:1000';
    // Método para obtener todas las órdenes de pedido
    public function index()
    {
        $ordenes = OrdenPedido::all();
        return response()->json($ordenes);
    }

    // Método para crear una nueva orden de pedido
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_op' => 'required|string|max:255',
            'id_empresa' => self::NULL_INT,
            'fecha_orden_pedido' => self::NULL_DATE,
            'fecha_programacion' => self::NULL_DATE,
            'tipo_envio' => self::NULL_STRING100,
            'id_proveedor' => 'required|string|max:100',
            'contacto_proveedor' => self::NULL_STRING100,
            'nota_pedido' => self::NULL_STRING1000,
            'fecha_recepcion' => self::NULL_DATE,
            'tipo_pago' => self::NULL_STRING100,
            'nota_pago' => self::NULL_STRING1000,
            'etiquetado' => self::NULL_STRING1000,
            'embalaje' => self::NULL_STRING1000,
            'observaciones' => self::NULL_STRING1000,
            'total_proveedor' => 'nullable|numeric',
            'id_transporte' => self::NULL_INT,
            'contacto_transporte' => self::NULL_STRING100,
            'cot_transporte' => self::NULL_STRING100,
            'flete' => self::NULL_STRING100,
            't_departamento' => self::NULL_STRING100,
            't_provincia' => self::NULL_STRING100,
            't_distrito' => self::NULL_STRING100,
            't_direccion' => self::NULL_STRING100,
            'transporte_nota' => self::NULL_STRING100,
            't_factura' => self::NULL_STRING100,
            't_grt' => self::NULL_STRING100,
            't_fecha_pago' => self::NULL_DATE,
            'estado_op' => self::NULL_STRING100,
            'fecha_entrega' => self::NULL_DATE,
            'retorno_mercaderia' => self::NULL_STRING100,
            'cargo_oea' => self::NULL_STRING100,
            'nota_op' => 'nullable|string|max:5000',
            'id_seguimiento' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $ordenPedido = OrdenPedido::create($request->all());
        return response()->json($ordenPedido, 201);
    }

    // Método para obtener una orden de pedido específica
    public function show($id)
    {
        $ordenPedido = OrdenPedido::find($id);
        if (!$ordenPedido) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }
        return response()->json($ordenPedido);
    }

    // Método para actualizar una orden de pedido
    public function update(Request $request, $id)
    {
        $ordenPedido = OrdenPedido::find($id);
        if (!$ordenPedido) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_op' => 'nullable|string|max:255',
            'id_empresa' => self::NULL_INT,
            'fecha_orden_pedido' => self::NULL_DATE,
            'fecha_programacion' => self::NULL_DATE,
            'tipo_envio' => self::NULL_STRING100,
            'id_proveedor' => self::NULL_STRING100,
            'contacto_proveedor' => self::NULL_STRING100,
            'nota_pedido' => self::NULL_STRING1000,
            'fecha_recepcion' => self::NULL_DATE,
            'tipo_pago' => self::NULL_STRING100,
            'nota_pago' => self::NULL_STRING1000,
            'etiquetado' => self::NULL_STRING1000,
            'embalaje' => self::NULL_STRING1000,
            'observaciones' => self::NULL_STRING1000,
            'total_proveedor' => 'nullable|numeric',
            'id_transporte' => self::NULL_INT,
            'contacto_transporte' => self::NULL_STRING100,
            'cot_transporte' => self::NULL_STRING100,
            'flete' => self::NULL_STRING100,
            't_departamento' => self::NULL_STRING100,
            't_provincia' => self::NULL_STRING100,
            't_distrito' => self::NULL_STRING100,
            't_direccion' => self::NULL_STRING100,
            'transporte_nota' => self::NULL_STRING100,
            't_factura' => self::NULL_STRING100,
            't_grt' => self::NULL_STRING100,
            't_fecha_pago' => self::NULL_DATE,
            'estado_op' => self::NULL_STRING100,
            'fecha_entrega' => self::NULL_DATE,
            'retorno_mercaderia' => self::NULL_STRING100,
            'cargo_oea' => self::NULL_STRING100,
            'nota_op' => 'nullable|string|max:5000',
            'id_seguimiento' => self::NULL_INT,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $ordenPedido->update($request->all());
        return response()->json($ordenPedido);
    }

    // Método para eliminar una orden de pedido
    public function destroy($id)
    {
        $ordenPedido = OrdenPedido::find($id);
        if (!$ordenPedido) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }

        $ordenPedido->delete();
        return response()->json(['message' => 'Orden de pedido eliminada exitosamente']);
    }
}
