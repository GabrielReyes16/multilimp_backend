<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

//Lectura de PDF
use Smalot\PdfParser\Parser;

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
        $seguimientos = Seguimiento::with(['empresa', 'cliente', 'ordenPedido', 'contactoCobrador', 'contactoCliente'])->get();
        return response()->json($seguimientos, 200);
    }


    public function show($id)
    {
        $seguimiento = Seguimiento::with('empresa', 'cliente', 'ordenPedido','contactoCobrador', 'contactoCliente')->find($id);

        if (!$seguimiento)
        {
            return response()->json(['message' => self::NOT_FOUND_MSG], 404);
        }
        return response() -> json($seguimiento, 201);
    }

    //Preprocesamiento de pdf
    public function preProcess(Request $request)
    {
        // Validar que el archivo esté presente y sea PDF
        $validator = Validator::make($request->all(), [
            'pdf_file' => 'required|file|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'El archivo es obligatorio y debe ser un PDF.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $parser = new Parser();
            $pdf = $parser->parseFile($request->file('pdf_file')->getPathname());
            $text = $pdf->getText();

            // Extraer información del texto (esto puede requerir ajustes según el formato del PDF)
            $data = [
                // fecha maxima del plazo de entrega
                'fecha_max_form' => $this->extractDate($text, 'Fecha Máxima Formulario'),
                //monto de la venta
                'monto_venta' => $this->extractAmount($text, 'Monto venta'),
                // //lugar de entrega
                'cdireccion' => $this->extractValue($text, 'Direccion'),
                'cdepartamento' => $this->extractValue($text, 'Departamento'),
                'cprovincia' => $this->extractValue($text, 'Provincia'),
                'cdistrito' => $this->extractValue($text, 'Distrito'),
                // //OP PERU COMPRAS
                // 'productos' => $this->extractProducts($text, 'Productos'),
                // //Expediente siaf
                'siaf' => $this->extractValue($text, 'SIAF'),
            ];

            return response()->json([
                'message' => 'Datos extraídos correctamente.',
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al procesar el archivo PDF.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    protected function extractDate($text, $field)
    {
        if ($field === 'Fecha Máxima Formulario' && preg_match('/Plazo de entrega\s*:\s*Del\s*\d{2}\/\d{2}\/\d{4}\s*al\s*(\d{2}\/\d{2}\/\d{4})/', $text, $matches)) {
            return $matches[1];
        }

        return null; // Retorna null si no encuentra la fecha
    }

    protected function extractAmount($text, $field)
    {
        if ($field ==='Monto venta' && preg_match('/IMPORTE TOTAL \(PEN\)\s*([\d,]+\.\d{2})/', $text, $matches)) {
            return str_replace (',', '.', $matches[1]);
        }
    }
    protected function extractValue($text, $field)
{
    switch($field) {
        default: $value = null;
        break;

        case 'Direccion':
            $value = null; // Inicializamos la variable
            if (preg_match('/Domicilio Fiscal\s*:\s*(.*?)(?=\s*Ubigeo)/s', $text, $matches)) {
                $value = trim($matches[1]);
                $value = str_replace("\n", " ", $value);
            }
            break;

        case 'Distrito':
            if (preg_match('/Ubigeo\s*:\s*(\S+)/', $text, $matches)) {
                $value = trim($matches[1]);
            }
            break;

        case 'Provincia':
            if (preg_match('/Ubigeo\s*:\s*[^\/]+\/\s*(\S+)/', $text, $matches)) {
                $value = trim($matches[1]);
            }
            break;

        case 'Departamento':
            if (preg_match('/Ubigeo\s*:\s*.*\/\s*(\S+)/', $text, $matches)) {
                $value = trim($matches[1]);
            }
            break;

        case 'SIAF':
                if(preg_match('/Expediente SIAF\s*:\s*(\S+)/', $text, $matches)){
                    $value = trim($matches[1]);
                }
                break;
    }
    return $value;
}

// protected function extractProducts($text, $field)
// {
//     if ($field === 'Productos') {
//         // Encuentra la posición de "Importe (PEN)" y captura el texto que sigue
//         $startPosition = strpos($text, 'Importe (PEN)');
//         if ($startPosition === false) {
//             return []; // Si no se encuentra "Importe (PEN)", retorna un arreglo vacío
//         }

//         // Extrae el texto después de "Importe (PEN)"
//         $text = substr($text, $startPosition);

//         // Expresión regular para capturar la cantidad (primer número entero sin letras después)
//         // y la información hasta "IMPORTE TOTAL (PEN)"
//         preg_match('/\b(\d+)\b\s+(?![a-zA-Z])+(.*?)(?=IMPORTE TOTAL \(PEN\))/s', $text, $matches);

//         if (!empty($matches)) {
//             $cantidad = trim($matches[1]); // Cantidad como primer número entero
//             $informacion = trim($matches[2]); // Resto del texto como información del producto hasta "IMPORTE TOTAL (PEN)"

//             return [
//                 [
//                     'cantidad' => $cantidad,
//                     'informacion' => $informacion
//                 ]
//             ];
//         }

//         return []; // Retorna un arreglo vacío si no hay coincidencias
//     }

//     return null; // Retorna null si el campo no es "Productos"
// }





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
