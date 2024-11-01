<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;

use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Cotizacion;
use App\Models\ContactoCliente;
use App\Models\CotizacionProducto;

class CotizacionController extends Controller
{
    private const NOT_FOUND = 'Cotización no encontrada';
    private const MONTO_PATTERN = "/[^0-9.-]/";

    public function index(Request $request)
    {
        $cotizaciones = Cotizacion::with('productos', 'empresa', 'cliente', 'contactoCliente' )->get();

        return response()->json($cotizaciones, 200);
    }

    public function store(Request $request)
    {
        // Inicializar $fechaEntrega como null
        $fechaEntrega = null;

        // Verifica si la fecha de entrega está presente y no es null
        if ($request->filled('fecha_entrega')) {
            try {
                // Intentar convertir la fecha de entrega de d/m/Y a Y-m-d
                $fechaEntrega = Carbon::createFromFormat('d/m/Y', $request->fecha_entrega)->format('Y-m-d');
            } catch (InvalidFormatException $e) {
                return response()->json(['error' => 'Formato de fecha no válido'], 400);
            }
        }

        // Obtener empresa y calcular el código de la cotización
        $empresa = Empresa::where('id', $request->id_empresa)->latest()->first();
        $conteo = Cotizacion::where('id_empresa', '=', $request->id_empresa)->count();

        $datos = new Cotizacion();
        $datos->id_cotizacion = strtoupper('COTIZ-'.substr($empresa['razon_social'], 0, 3)).'-'.(intval($conteo) + 1);
        $datos->id_cliente = $request->id_cliente;
        $datos->id_empresa = $request->id_empresa;
        $datos->id_contacto_cliente = $request->id_contacto_cliente;
        $datos->monto = number_format(floatval(preg_replace(self::MONTO_PATTERN, "", $request->monto)), 2, '.', '');
        $datos->tipo_pago = $request->tipo_pago;
        $datos->nota_pago = $request->nota_pago;
        $datos->nota_pedido = $request->nota_pedido;
        $datos->c_direccion = $request->c_direccion;
        $datos->c_distrito = $request->c_distrito;
        $datos->c_provincia = $request->c_provincia;
        $datos->c_departamento = $request->c_departamento;
        $datos->c_referencia = $request->c_referencia;
        $datos->estado = $request->estado;
        $datos->fecha_cotizacion = Carbon::now('America/Lima');
        $datos->fecha_entrega = $fechaEntrega;
        $datos->save();

        return response()->json(['message' => 'Cotización guardada con éxito', 'cotizacion' => $datos], 201);
    }

    public function show($id)
    {
        $cotizacion = Cotizacion::with('productos')->find($id);


        if (!$cotizacion) {
            return response()->json(['error' => self::NOT_FOUND], 404);
        }

        return response()->json($cotizacion, 201);
    }

    public function update(Request $request, $id)
    {
        // Inicializar $fechaEntrega como null
        $fechaEntrega = null;

        // Verifica si la fecha de entrega está presente y no es null
        if ($request->filled('fecha_entrega')) {
            try {
                // Intentar convertir la fecha de entrega de d/m/Y a Y-m-d
                $fechaEntrega = Carbon::createFromFormat('d/m/Y', $request->fecha_entrega)->format('Y-m-d');
            } catch (InvalidFormatException $e) {
                return response()->json(['error' => 'Formato de fecha no válido'], 400);
            }
        }

        $cotizacion = Cotizacion::find($id);
        if (!$cotizacion) {
            return response()->json(['error' => self::NOT_FOUND], 404);
        }

        $cotizacion->id_cliente = $request->id_cliente;
        $cotizacion->id_contacto_cliente = $request->id_contacto_cliente;
        $cotizacion->monto = number_format(floatval(preg_replace(self::MONTO_PATTERN, "", $request->monto)), 2, '.', '');
        $cotizacion->tipo_pago = $request->tipo_pago;
        $cotizacion->nota_pago = $request->nota_pago;
        $cotizacion->nota_pedido = $request->nota_pedido;
        $cotizacion->c_direccion = $request->c_direccion;
        $cotizacion->c_distrito = $request->c_distrito;
        $cotizacion->c_provincia = $request->c_provincia;
        $cotizacion->c_departamento = $request->c_departamento;
        $cotizacion->c_referencia = $request->c_referencia;
        $cotizacion->estado = $request->estado;
        $cotizacion->fecha_entrega = $fechaEntrega;
        $cotizacion->save();

        return response()->json(['message' => 'Cotización actualizada con éxito', 'cotizacion' => $cotizacion], 200);
    }

    public function destroy($id)
    {
        $cotizacion = Cotizacion::find($id);
        if (!$cotizacion) {
            return response()->json(['error' => self::NOT_FOUND], 404);
        }

        $cotizacion->delete();
        return response()->json(['message' => 'Cotización eliminada con éxito'], 200);
    }

    public function producto(Request $request)
    {
        $datos = $request->except(['_token']);
        $datos['precio_unitario'] = number_format(floatval(preg_replace(self::MONTO_PATTERN, "", $request->precio_unitario)), 4, '.', '');
        $datos['total'] = number_format(floatval(preg_replace(self::MONTO_PATTERN, "", $request->total)), 2, '.', '');

        CotizacionProducto::insert($datos);

        return response()->json(['message' => 'Producto agregado con éxito'], 201);
    }

    public function eliminarProducto($id)
    {
        CotizacionProducto::destroy($id);

        return response()->json(['message' => 'Producto eliminado con éxito'], 200);
    }
}

