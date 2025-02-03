<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\GestionCobranza;

class GestionCobranzaController extends Controller
{
    //Listar todas las gestiones agrupadas por seguimiento
    public function index()
    {
        $gestionCobranza = GestionCobranza::orderBy('id_seguimiento')
            ->get()
            ->groupBy('id_seguimiento');
        return response()->json($gestionCobranza);
    }

    //Listar las gestionas de un seguimiento
    public function show($id)
    {
        $gestionCobranza = GestionCobranza::where('id_seguimiento', $id)->get();
        return response()->json($gestionCobranza);
    }

    //Crear una nueva gestion
    public function store(Request $request)
    {
        $request->validate([
            'id_seguimiento' => 'required|integer',
            'historial' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'fecha_gestion' => 'required|date',
            'documento' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048', // Validación del archivo
            'estado' => 'nullable|integer',
        ]);

        // Guardar el archivo en el directorio 'gestiones_docs'
        if ($request->hasFile('documento')) {
            $documento = $request->file('documento');
            $documentoNombre = time() . '_' . $documento->getClientOriginalName();
            $documentoPath = $documento->storeAs('gestiones_docs', $documentoNombre, 'public');
        }

        // Crear el registro en la base de datos
        $gestionCobranza = GestionCobranza::create([
            'id_seguimiento' => $request->id_seguimiento,
            'historial' => $request->historial,
            'descripcion' => $request->descripcion,
            'fecha_gestion' => $request->fecha_gestion,
            'documento_url' => $documentoPath ?? null, // Guardar la ruta del archivo
            'estado' => $request->estado,
        ]);

        return response()->json($gestionCobranza, 201);
    }

    //Descargar el documento de una gestion
    public function downloadDocumento($id)
    {
        // Buscar la gestión por su ID
        $gestionCobranza = GestionCobranza::find($id);

        // Validar si la gestión existe
        if (!$gestionCobranza) {
            return response()->json(['error' => 'Gestión no encontrada'], 404);
        }

        // Validar si hay un documento asociado
        if (empty($gestionCobranza->documento_url)) {
            return response()->json(['error' => 'No hay documento asociado a esta gestión'], 404);
        }

        // Construir la ruta completa del archivo
        $rutaArchivo = storage_path('app/public/' . $gestionCobranza->documento_url);

        // Validar si el archivo existe
        if (!file_exists($rutaArchivo)) {
            return response()->json(['error' => 'El archivo no existe'], 404);
        }

        // Descargar el archivo
        return response()->download($rutaArchivo);
    }
}
