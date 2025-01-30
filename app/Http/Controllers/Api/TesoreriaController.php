<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Modelos importados
use App\Models\Tesoreria;

class TesoreriaController extends Controller
{
    //Listado general
    public function index()
    {
        $tesorerias = Tesoreria::with('orden_pedido', 'seguimiento')->get();
        return response()->json($tesorerias);
    }

    // Insertar un nuevo registro de tesorería
    public function registro(Request $request)
    {
        $request->validate([
            'fecha_pago' => 'required|date',
            'banco' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'total' => 'required|numeric',
            'id_orden_pedido' => 'required|integer',
            'id_seguimiento' => 'required|integer',
            'estado' => 'required|integer',
        ]);

        $tesoreria = Tesoreria::create($request->all());
        return response()->json($tesoreria, 201);
    }

    // Obtener registro de tesorería por ID
    public function show($id)
    {
        $tesoreria = Tesoreria::with('orden_pedido', 'seguimiento')->find($id);
        if (!$tesoreria) {
            return response()->json(['message' => 'Registro de tesorería no encontrado'], 404);
        }
        return response()->json($tesoreria, 201);
    }

    // Traer información de tesorería para editar
    public function edit($id)
    {
        $tesoreria = Tesoreria::find($id);
        if (!$tesoreria) {
            return response()->json(['message' => 'Registro de tesorería no encontrado'], 404);
        }
        return response()->json($tesoreria, 201);
    }

    // Actualizar registro de tesorería
    public function update(Request $request, Tesoreria $tesoreria)
    {
        $request->validate([
            'fecha_pago' => 'required|date',
            'banco' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'total' => 'required|numeric',
            'id_orden_pedido' => 'required|integer',
            'id_seguimiento' => 'required|integer',
            'estado' => 'required|integer',
        ]);

        $tesoreria->update($request->all());
        return response()->json($tesoreria, 200);
    }
}
