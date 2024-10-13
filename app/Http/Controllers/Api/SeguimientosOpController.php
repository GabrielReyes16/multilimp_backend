<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Seguimiento;

class SeguimientosOpController extends Controller
{
    private const DOC_PATH = 'public/doc';

    public function index(Request $request)
    {
        $seguimientos = Seguimiento::with(['empresa', 'cliente']) // Carga relaciones si es necesario
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($seguimientos, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Añade las reglas de validación que necesites
            'id_empresa' => 'required|exists:empresas,id',
            'id_cliente' => 'required|exists:clientes,id',
            'catalogo' => 'required|string',
            // Añadir más validaciones según sea necesario
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $datos = $request->all();

        if ($request->hasFile('oce')) {
            $nombreArchivo = $request->file('oce')->getClientOriginalName();
            $datos['oce'] = $request->file('oce')->storeAs(self::DOC_PATH, $nombreArchivo);
        }

        if ($request->hasFile('ocf')) {
            $nombreArchivo = $request->file('ocf')->getClientOriginalName();
            $datos['ocf'] = $request->file('ocf')->storeAs(self::DOC_PATH, $nombreArchivo);
        }

        $seguimiento = Seguimiento::create($datos);

        return response()->json($seguimiento, 201);
    }

    public function show($id)
    {
        $seguimiento = Seguimiento::with(['empresa', 'cliente'])->findOrFail($id);

        return response()->json($seguimiento, 200);
    }

    public function update(Request $request, $id)
    {
        $seguimiento = Seguimiento::findOrFail($id);

        $validator = Validator::make($request->all(), [
            // Añade las reglas de validación que necesites
            'id_empresa' => 'sometimes|required|exists:empresas,id',
            'id_cliente' => 'sometimes|required|exists:clientes,id',
            // Añadir más validaciones según sea necesario
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $datos = $request->all();

        if ($request->hasFile('oce')) {
            $nombreArchivo = $request->file('oce')->getClientOriginalName();
            $datos['oce'] = $request->file('oce')->storeAs(self::DOC_PATH, $nombreArchivo);
        }

        if ($request->hasFile('ocf')) {
            $nombreArchivo = $request->file('ocf')->getClientOriginalName();
            $datos['ocf'] = $request->file('ocf')->storeAs(self::DOC_PATH, $nombreArchivo);
        }

        $seguimiento->update($datos);

        return response()->json($seguimiento, 200);
    }

    public function destroy($id)
    {
        $seguimiento = Seguimiento::findOrFail($id);
        $seguimiento->delete();

        return response()->json(['message' => 'Seguimiento eliminado con éxito'], 200);
    }
}
