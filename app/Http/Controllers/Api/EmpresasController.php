<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Empresa;
use App\Models\CatalogoEmpresa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmpresasController extends Controller
{
    private const NOT_FOUND = 'Empresa not found';
    private const NULLABLE_STRING = 'nullable|string';

    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $empresas = Empresa::with('catalogos')->get(); // Cargar los catálogos relacionados
    return response()->json($empresas);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ruc' => self::NULLABLE_STRING,
            'razon_social' => self::NULLABLE_STRING,
            'cod_unidad' => self::NULLABLE_STRING,
            'departamento' => self::NULLABLE_STRING,
            'provincia' => self::NULLABLE_STRING,
            'distrito' => self::NULLABLE_STRING,
            'direccion' => self::NULLABLE_STRING,
            'logo' => 'nullable|image|mimes:png,jpg,jpeg',
            'correo' => 'nullable|email',
            'web' => self::NULLABLE_STRING,
            'direcciones' => self::NULLABLE_STRING,
            'telefono' => self::NULLABLE_STRING,
            'estado' => 'nullable|integer',
        ]);

        //Manejo del logo
        if ($request->hasFile('logo')) {
            $nombreLogo = $request-> file('logo')->getClientOriginalName();
            $path = 'logos/'. $nombreLogo;
            $validatedData['logo'] = $path;
            $request->file('logo')->storeAs('logos', $nombreLogo, 'public' );
        }

        $empresa = Empresa::create($validatedData);
        return response()->json($empresa, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $empresa = Empresa::with('catalogos')->find($id); // Cargar los catálogos relacionados

    if (!$empresa) {
        return response()->json(['message' => self::NOT_FOUND], 404);
    }

    return response()->json($empresa, 201);
}
public function getLogo($id)
{
    $empresa = Empresa::find($id);

    if (!$empresa || !$empresa->logo) {
        return response()->json(['message' => self::NOT_FOUND], 404);
    }

    // Obtiene la ruta completa del logo desde el almacenamiento público
    $path = storage_path('app/public/' . $empresa->logo);

    if (!file_exists($path)) {
        return response()->json(['message' => 'Logo file not found'], 404);
    }

    // Retorna el archivo de imagen como una respuesta
    return response()->file($path);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return response()->json(['message' => self::NOT_FOUND], 404);
        }

        $validatedData = $request->validate([
            'ruc' => self::NULLABLE_STRING,
            'razon_social' => self::NULLABLE_STRING,
            'cod_unidad' => self::NULLABLE_STRING,
            'departamento' => self::NULLABLE_STRING,
            'provincia' => self::NULLABLE_STRING,
            'distrito' => self::NULLABLE_STRING,
            'direccion' => self::NULLABLE_STRING,
            'logo' => self::NULLABLE_STRING,
            'correo' => 'nullable|email',
            'web' => self::NULLABLE_STRING,
            'direcciones' => self::NULLABLE_STRING,
            'telefono' => self::NULLABLE_STRING,
            'estado' => 'nullable|integer',
        ]);

        $empresa->update($validatedData);
        return response()->json($empresa, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        $empresa-> estado = 0;
        $empresa ->save();
        return response()->json(['message' => 'Empresa desactivada exitosamente'], 200);
    }
}
