<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\ContactoCliente;
use App\Models\Contra;
use App\Models\Empresa;
use App\Models\Seguimiento;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeguimientosController extends Controller
{
    // Constantes
    private const NULLABLE_STRING_RULE = 'nullable|string';
    private const FORMAT_DATE = 'nullable|date_format:Y-m-d';
    private const NOT_FOUND_MSG = 'Seguimiento no encontrado';
    private const INTERNAL_SERVER_ERROR = 'Error interno del servidor';
    private const NULLABLE_FILE_PDF = 'nullable|file|mimes:pdf';
    private const DOCS = 'docs/';

    // Listar todos los seguimientos (GET)
    public function index()
    {
        $seguimientos = Seguimiento::with(['empresa', 'cliente'])->get();
        return response()->json($seguimientos, 200);
    }


    // Crear un nuevo seguimiento (POST)
    public function store(Request $request)
    {
        try {
            // Valida los datos recibidos en el request
            $validatedData = $request->validate([
                'fecha_emision' => self::FORMAT_DATE,
                'oce' => self::NULLABLE_FILE_PDF,
                'ocf' => self::NULLABLE_FILE_PDF,
                'id_empresa' => 'required|integer|exists:empresas,id',
                'id_cliente' => 'required|integer|exists:clientes,id',
                'catalogo' => self::NULLABLE_STRING_RULE,
                'fecha_form' => self::FORMAT_DATE,
                'fecha_max_form' => self::FORMAT_DATE,
                'fecha_siaf' => self::FORMAT_DATE,
                'monto_venta' => 'nullable|numeric',
                'cdireccion' => self::NULLABLE_STRING_RULE,
                'cdepartamento' => self::NULLABLE_STRING_RULE,
                'cprovincia' => self::NULLABLE_STRING_RULE,
                'cdistrito' => self::NULLABLE_STRING_RULE,
                'productos' => self::NULLABLE_STRING_RULE,
                'siaf' => self::NULLABLE_STRING_RULE,
                'etapa_siaf' => self::NULLABLE_STRING_RULE,
                'contacto_cliente' => self::NULLABLE_STRING_RULE,
            ]);

            // Verificar Empresa y Cliente
            $empresa = Empresa::find($request->id_empresa);
            $cliente = Cliente::find($request->id_cliente);

            if (!$empresa || !$cliente) {
                $response = ['message' => 'Empresa o Cliente no encontrado'];
                $statusCode = 404;
            } else {
// Manejo del archivo OCE
                if ($request->hasFile('oce')) {
                    $nombreArchivoOce = $request->file('oce')->getClientOriginalName();
                    $oce_doc_path = self::DOCS . $nombreArchivoOce;

                    // Verificar si el archivo ya existe
                    if (Storage::disk('public')->exists($oce_doc_path)) {
                        return response()->json([
                            'message' => 'El archivo OCE ya existe en el sistema.',
                        ], 422);
                    }

                    // Guardar el archivo si no existe
                    $request->file('oce')->storeAs('docs', $nombreArchivoOce, 'public');
                    $validatedData['oce'] = $oce_doc_path; // Guardar la ruta en la base de datos
                }

// Manejo del archivo OCF
                if ($request->hasFile('ocf')) {
                    $nombreArchivoOcf = $request->file('ocf')->getClientOriginalName();
                    $ocf_doc_path = self::DOCS . $nombreArchivoOcf;

                    // Verificar si el archivo ya existe
                    if (Storage::disk('public')->exists($ocf_doc_path)) {
                        return response()->json([
                            'message' => 'El archivo OCF ya existe en el sistema.',
                        ], 422);
                    }

                    // Guardar el archivo si no existe
                    $request->file('ocf')->storeAs('docs', $nombreArchivoOcf, 'public');
                    $validatedData['ocf'] = $ocf_doc_path; // Guardar la ruta en la base de datos
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

                $response = [
                    'message' => 'Seguimiento registrado correctamente.',
                    'data' => $seguimiento,
                ];
                $statusCode = 201;
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            $response = [
                'message' => 'Errores de validacion',
                'errors' => $e->errors(),
            ];
            $statusCode = 422;
        } catch (\Exception $e) {
            $response = [
                'message' => self::INTERNAL_SERVER_ERROR,
                'error' => $e->getMessage(),
            ];
            $statusCode = 500;
        }
        return response()->json($response, $statusCode);
    }

    public function show($id)
    {
        try {
            // Obtener la contraseña (por ejemplo, para validar acceso)
            $contra = Contra::find(1);

            // Obtener el seguimiento específico, lanzar error 404 si no se encuentra
            $seguimiento = Seguimiento::findOrFail($id);

            // Obtener los clientes cuyo estado no sea 1 o que tengan estado nulo
            $clientes = Cliente::where('estado', '<>', 1)->orWhereNull('estado')->get();

            // Obtener las empresas cuyo estado no sea 1 o que tengan estado nulo
            $empresas = Empresa::where('estado', '<>', 1)->orWhereNull('estado')->get();

            // Obtener los contactos del cliente asociado al seguimiento
            $contactos = ContactoCliente::where('id_cliente', '=', $seguimiento->id_cliente)->get();

            // Retornar los datos en formato JSON con código 200 (OK)
            return response()->json([
                'contra' => $contra,
                'seguimiento' => $seguimiento,
                'clientes' => $clientes,
                'empresas' => $empresas,
                'contactos' => $contactos,
            ], 200);

        } catch (ModelNotFoundException $e) {
            // Si no se encuentra el seguimiento, retornar mensaje de error con código 404 (No encontrado)
            return response()->json(['message' => self::NOT_FOUND_MSG], 404);
        } catch (\Exception $e) {
            // Retornar mensaje genérico de error si ocurre algún otro problema con código 500 (Error interno)
            return response()->json(['message' => self::INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()], 500);
        }
    }

    // Actualizar un seguimiento (PUT/PATCH)
    public function update(Request $request, $id)
    {
        try {
                    // Log para ver los datos recibidos
        \Log::info($request->all());
            // Verificar si el seguimiento existe primero
            $seguimiento = Seguimiento::find($id);
            if (!$seguimiento) {
                return response()->json(['message' => self::NOT_FOUND_MSG], 404); // Respuesta si no se encuentra
            }

            // Validar los datos recibidos en el request
            $validatedData = $request->validate([
                'fecha_emision' => self::FORMAT_DATE,
                'oce' => self::NULLABLE_FILE_PDF,
                'ocf' => self::NULLABLE_FILE_PDF,
                'id_empresa' => 'required|integer|exists:empresas,id',
                'id_cliente' => 'required|integer|exists:clientes,id',
                'catalogo' => self::NULLABLE_STRING_RULE,
                'fecha_form' => self::FORMAT_DATE,
                'fecha_max_form' => self::FORMAT_DATE,
                'fecha_siaf' => self::FORMAT_DATE,
                'monto_venta' => 'nullable|numeric',
                'cdireccion' => self::NULLABLE_STRING_RULE,
                'cdepartamento' => self::NULLABLE_STRING_RULE,
                'cprovincia' => self::NULLABLE_STRING_RULE,
                'cdistrito' => self::NULLABLE_STRING_RULE,
                'productos' => self::NULLABLE_STRING_RULE,
                'siaf' => self::NULLABLE_STRING_RULE,
                'etapa_siaf' => self::NULLABLE_STRING_RULE,
                'contacto_cliente' => self::NULLABLE_STRING_RULE,
            ]);

            // Manejo del archivo OCE
            if ($request->hasFile('oce')) {
                $nombreArchivoOce = $request->file('oce')->getClientOriginalName();
                $oce_doc_path = self::DOCS . $nombreArchivoOce;

                // Verificar si el archivo ya existe
                if (Storage::disk('public')->exists($oce_doc_path)) {
                    return response()->json(['message' => 'El archivo OCE ya existe en el sistema.'], 422);
                }

                // Eliminar el archivo existente
                if ($seguimiento->oce && Storage::disk('public')->exists($seguimiento->oce)) {
                    Storage::delete($seguimiento->oce);
                }

                // Guardar el archivo si no existe
                $request->file('oce')->storeAs('docs', $nombreArchivoOce, 'public');
                $validatedData['oce'] = $oce_doc_path; // Guardar la ruta en la base de datos
            }

            // Manejo del archivo OCF
            if ($request->hasFile('ocf')) {
                $nombreArchivoOcf = $request->file('ocf')->getClientOriginalName();
                $ocf_doc_path = self::DOCS . $nombreArchivoOcf;

                // Verificar si el archivo ya existe
                if (Storage::disk('public')->exists($ocf_doc_path)) {
                    return response()->json(['message' => 'El archivo OCF ya existe en el sistema.'], 422);
                }

                // Eliminar el archivo existente
                if ($seguimiento->ocf && Storage::disk('public')->exists($seguimiento->ocf)) {
                    Storage::delete($seguimiento->ocf);
                }

                // Guardar el archivo si no existe
                $request->file('ocf')->storeAs('docs', $nombreArchivoOcf, 'public');
                $validatedData['ocf'] = $ocf_doc_path; // Guardar la ruta en la base de datos
            }
            // Formato del monto de venta
            if (!empty($request->monto_venta)) {
                $validatedData['monto_venta'] = number_format(floatval(preg_replace("/[^0-9.-]/", "", $request->monto_venta)), 2, '.', '');
            }

            // Actualizar el seguimiento con los datos validados
            $seguimiento->update($validatedData);

            return response()->json([
                'message' => 'Seguimiento actualizado correctamente.',
                'data' => $seguimiento,
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Errores de validacion',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => self::INTERNAL_SERVER_ERROR,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
