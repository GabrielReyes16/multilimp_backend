<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

//Modelos empleados
use\App\Models\Seguimiento;
use App\Models\Cotizacion;

class DashboardController extends Controller
{
    //OC ingresadas hoy
    public function OC_today()
    {
        // Cantidad de registros insertados en la fecha actual
        $hoy = Carbon::today();
        $registrosHoy = Seguimiento::whereDate('created_at', $hoy)->count();

        return response()->json([
            'registrosHoy' => $registrosHoy
        ]);
    }
    //OC sin fecha_factura
    public function OC_WihtoutFechaFactura()
    {
        $sinFechaFactura = Seguimiento::whereNull('fecha_factura')->count();

        return response()->json([
            'sinFechaFactura' => $sinFechaFactura
        ]);
    }

        // Cotizaciones realizadas hoy
        public function cotizacionesToday()
        {
            $hoy = Carbon::today();
            $cotizacionesHoy = Cotizacion::whereDate('created_at', $hoy)->count();

            return response()->json([
                'cotizacionesHoy' => $cotizacionesHoy
            ]);
        }
}
