<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Modelos importados
use App\Models\Facturacion;

class FacturacionController extends Controller
{
    public function index()
    {
        $facturacion = Facturacion::all();
        return response()->json($facturacion, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_venta' => 'required|integer',
            'factura' => 'required|string|max:255',
            'fecha_factura' => 'required|date',
            'grr' => 'required|string|max:255',
            'retencion' => 'required|numeric',
            'detraccion' => 'required|numeric',
            'forma_envio' => 'required|string|max:255',
            're_factura' => 'nullable|string|max:255',
            're_fecha_factura' => 'nullable|date',
            're_grr' => 'nullable|nullable|max:255',
            're_detraccion' => 'nullable|numeric',
            're_retencion' => 'nullable|numeric',
            're_forma_envio' => 'nullable|string|max:255',
            'isActive' => 'nullable|integer',
        ]);

        $facturacion = Facturacion::create($request->all());
        return response()->json($facturacion, 201);
    }

    public function show($id)
    {
        $facturacion = Facturacion::find($id);
        if (!$facturacion) {
            return response()->json(['message' => 'Facturación no encontrada'], 404);
        }
        return response()->json($facturacion, 200);
    }

    public function update(Request $request, Facturacion $facturacion)
    {
        $request->validate([
            'id_venta' => 'required|integer',
            'factura' => 'required|string|max:255',
            'fecha_factura' => 'required|date',
            'grr' => 'required|string|max:255',
            'retencion' => 'required|numeric',
            'detraccion' => 'required|numeric',
            'forma_envio' => 'required|string|max:255',
            're_factura' => 'required|string|max:255',
            're_fecha_factura' => 'required|date',
            're_grr' => 'required|string|max:255',
            're_detraccion' => 'required|numeric',
            're_retencion' => 'required|numeric',
            're_forma_envio' => 'required|string|max:255',
            'isActive' => 'required|integer',
        ]);

        $facturacion->update($request->all());
        return response()->json($facturacion, 200);
    }

}
