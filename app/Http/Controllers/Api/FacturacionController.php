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
        $facturaciones = Facturacion::with('refacturaciones')->get();
        return response()->Json($facturaciones);
    }

    //Ver todo sobre una facturación en especifico
    public  function show($id)
    {
        $facturacion = Facturacion::with('refacturaciones')->find($id);
        if(!$facturacion){
            return response()->json(['message' => 'Registro de facturación no encontrado'], 404);
        }
        return response()->json($facturacion, 201);
    }

    //Info actual de cada factura
    public function actual($id)
    {
        $facturacion = Facturacion::with('refacturaciones')
            ->where('id', $id)
            ->where('estado', 1)
            ->first(); // Obtener solo un registro en lugar de una colección

        if (!$facturacion) {
            return response()->json(['error' => 'Facturación no encontrada'], 404);
        }

        if ($facturacion->refacturaciones->isEmpty()) {
            // No hay refacturaciones, devolver la facturación original
            return response()->json([
                'tipo' => 'factura_original',
                'data' => $facturacion
            ]);
        }

        // Hay refacturaciones, devolver la más reciente
        $ultimaRefacturacion = $facturacion->refacturaciones->sortByDesc('fecha_factura')->first();

        return response()->json([
            'tipo' => 'refactura',
            'data' => $ultimaRefacturacion
        ]);
    }
    //Crear facturacion, o agregar refacturacion si ya hay una facturacion existente
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
            'estado' => 'nullable|boolean',
        ]);

        // Buscar si ya existe una facturación con este número de factura
        $facturacionExistente = Facturacion::where('factura', $request->factura)->first();

        if (!$facturacionExistente) {
            // Si no existe, crear nueva facturación
            $facturacion = Facturacion::create($request->all());
            return response()->json([
                'mensaje' => 'Factura creada exitosamente',
                'data' => $facturacion
            ], 201);
        } else {
            // Si existe, crear refacturación
            $refacturacion = $facturacionExistente->refacturaciones()->create($request->all());
            return response()->json([
                'mensaje' => 'Refacturación creada exitosamente',
                'data' => $refacturacion
            ], 201);
        }
    }
    //Cambiar el estado de una factura o refactura
    public function cambiarEstado($id)
    {
        // Buscar si existe una facturación con este ID
        $facturacion = Facturacion::find($id);

        if (!$facturacion) {
            // Si no existe facturación con ese ID
            return response()->json([
                'mensaje' => 'Facturación no encontrada'
            ], 404);
        }

        // Cambiar estado a 0
        $facturacion->estado = 0;
        $facturacion->save();

        return response()->json([
            'mensaje' => 'Estado actualizado exitosamente',
            'data' => $facturacion
        ], 200);
    }
}
