<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seguimiento;
use App\Models\Empresa;
use App\Models\Cliente;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SeguimientosController extends Controller
{
    // Listar todos los seguimientos (GET)
    public function index()
    {
        $seguimientos = Seguimiento::all();
        return response()->json($seguimientos, 200);
    }

    // Mostrar un seguimiento específico (GET)
    public function show($id)
    {
        $seguimiento = Seguimiento::find($id);

        if (!$seguimiento) {
            return response()->json(['message' => 'Seguimiento no encontrado'], 404);
        }

        return response()->json($seguimiento, 200);
    }

    // Crear un nuevo seguimiento (POST)
    public function store(Request $request)
    {
        try {
            // Valida los datos recibidos en el request
            $validatedData = $request->validate([
                'fecha_emision' => 'nullable|date_format:Y-m-d',
                'oce_file' => 'nullable|file|mimes:pdf',
                'ocf_file' => 'nullable|file|mimes:pdf',
                'id_empresa' => 'required|integer|exists:empresas,id',
                'id_cliente' => 'required|integer|exists:clientes,id',
                'catalogo' => 'nullable|string',
                'fecha_form' => 'nullable|date_format:Y-m-d',
                'fecha_max_form' => 'nullable|date_format:Y-m-d',
                'fecha_siaf' => 'nullable|date_format:Y-m-d',
                'monto_venta' => 'nullable|numeric',
                'cdireccion' => 'nullable|string',
                'cdepartamento' => 'nullable|string',
                'cprovincia' => 'nullable|string',
                'cdistrito' => 'nullable|string',
                'productos' => 'nullable|string',
                'siaf' => 'nullable|string',
                'etapa_siaf' => 'nullable|string',
                'contacto_cliente' => 'nullable|string',
            ]);

            // Verificación del contenido de Empresa y Cliente
            $empresa = Empresa::find($request->id_empresa);
            $cliente = Cliente::find($request->id_cliente);

            if (!$empresa || !$cliente) {
                return response()->json(['message' => 'Empresa o Cliente no encontrado'], 404);
            }

            // Inicializar las rutas de los documentos
            $validatedData['oce_doc_path'] = null;
            $validatedData['ocf_doc_path'] = null;

            // Manejo del archivo OCE
            if ($request->hasFile('oce_file')) {
                $nombreArchivoOce = $request->file('oce_file')->getClientOriginalName();
                $oce_doc_path = $request->file('oce_file')->storeAs('docs', $nombreArchivoOce, 'public');
                $validatedData['oce_doc_path'] = url("storage/docs/$nombreArchivoOce");
            }

            // Manejo del archivo OCF
            if ($request->hasFile('ocf_file')) {
                $nombreArchivoOcf = $request->file('ocf_file')->getClientOriginalName();
                $ocf_doc_path = $request->file('ocf_file')->storeAs('docs', $nombreArchivoOcf, 'public');
                $validatedData['ocf_doc_path'] = url("storage/docs/$nombreArchivoOcf");
            }


            // Convertir fechas al formato 'Y-m-d' para la base de datos
            if (!empty($request->fecha_emision)) {
                $validatedData['fecha_emision'] = Carbon::createFromFormat('d/m/Y', $request->fecha_emision)->format('Y-m-d');
            }

            if (!empty($request->fecha_form)) {
                $validatedData['fecha_form'] = Carbon::createFromFormat('d/m/Y', $request->fecha_form)->format('Y-m-d');
            }

            if (!empty($request->fecha_max_form)) {
                $validatedData['fecha_max_form'] = Carbon::createFromFormat('d/m/Y', $request->fecha_max_form)->format('Y-m-d');
            }

            if (!empty($request->fecha_siaf)) {
                $validatedData['fecha_siaf'] = Carbon::createFromFormat('d/m/Y', $request->fecha_siaf)->format('Y-m-d');
            }

            // Formato del monto de venta
            if (!empty($request->monto_venta)) {
                $validatedData['monto_venta'] = number_format(floatval(preg_replace("/[^0-9.-]/", "", $request->monto_venta)), 2, '.', '');
            }

            // Generar el código de venta
            $conteo = Seguimiento::where('id_empresa', $request->id_empresa)->count();
            $validatedData['id_venta'] = strtoupper('OC-' . substr($empresa->razon_social, 0, 3)) . '-' . ($conteo + 1);

            // Crear el nuevo seguimiento
            $seguimiento = Seguimiento::create($validatedData);

            return response()->json([
                'message' => 'Seguimiento registrado correctamente.',
                'data' => $seguimiento,
                'empresa_info' => $empresa->only(['id', 'razon_social', 'ruc']),
                'cliente_info' => $cliente->only(['id', 'razon_social', 'ruc']),
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Errores de validacion',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error interno del servidor',
                'error' => $e->getMessage()
            ], 500);
        }
    }




    // Actualizar un seguimiento (PUT/PATCH)
    public function update(Request $request, $id)
    {
        $seguimiento = Seguimiento::find($id);

        if (!$seguimiento) {
            return response()->json(['message' => 'Seguimiento no encontrado'], 404);
        }

        // Validar los datos que vienen en la petición
        $validatedData = $request->validate([
            'id_empresa' => 'required|exists:empresas,id',
            'id_cliente' => 'required|exists:clientes,id',
            'catalogo' => 'required|string',
            'monto_venta' => 'required|numeric',
            'fecha_emision' => 'required|date_format:d/m/Y',
        ]);

        // Actualizar el seguimiento
        $seguimiento->update($validatedData);

        return response()->json([
            'message' => 'Seguimiento actualizado exitosamente',
            'seguimiento' => $seguimiento
        ], 200);
    }

    // Eliminar un seguimiento (DELETE)
    public function destroy($id)
    {
        $seguimiento = Seguimiento::find($id);

        if (!$seguimiento) {
            return response()->json(['message' => 'Seguimiento no encontrado'], 404);
        }

        // Eliminar el seguimiento
        $seguimiento->delete();

        return response()->json([
            'message' => 'Seguimiento eliminado exitosamente'
        ], 200);
    }
}
