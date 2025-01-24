<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Modelos importados
use App\Models\Tesoreria;

class TesoreriaController extends Controller
{
    // Constantes de validación
    private const REQ_STRING_255 = 'required|string|max:255';
    private const REQ_INT = 'required|integer';

    // Insertar un nuevo registro de tesorería
    public function registro(Request $request)
    {
        $request->validate([
            'fecha_pago' => 'required|date',
            'banco' => self::REQ_STRING_255,
            'descripcion' => self::REQ_STRING_255,
            'total' => 'required|numeric',
            'id_orden_pedido' => self::REQ_INT,
            'id_seguimiento' => self::REQ_INT,
            'estado' => self::REQ_INT,
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
            'banco' => self::REQ_STRING_255,
            'descripcion' => self::REQ_STRING_255,
            'total' => 'required|numeric',
            'id_orden_pedido' => self::REQ_INT,
            'id_seguimiento' => self::REQ_INT,
            'estado' => self::REQ_INT,
        ]);

        $tesoreria->update($request->all());
        return response()->json($tesoreria, 200);
    }
}
