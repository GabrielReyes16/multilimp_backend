<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductosStock;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductoStockController extends Controller
{
    public function index()
    {
        return ProductosStock::select('id', 'codigo', 'marca', 'descripcion', 'categoria', 'stock', 'almacen', 'isActive')->get();
    }

    public function show($id)
    {
        return ProductosStock::select('id', 'codigo', 'marca', 'descripcion', 'categoria', 'stock', 'almacen', 'isActive')
            ->where('id', $id)
            ->first();
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo'       => 'required|string',
            'marca'        => 'required|string|max:100',
            'descripcion'  => 'required|string|max:255',
            'categoria'    => 'required|string|max:100',
            'stock'        => 'required|integer',
            'almacen'      => 'nullable|string|max:50',
            'foto_archivo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'isActive'     => 'nullable|boolean',
        ]);

        //Guardar la foto en el directorio
        if($request->hasFile('foto_archivo')){
            $foto = $request->file('foto_archivo');
            $fotoNombre = time().'_'.$foto->getClientOriginalName();
            $fotoPath = $foto->storeAs('fotos_productos', $fotoNombre, 'public');
        }

        //Crear el registro en la base de datos
        $producto = ProductosStock::create([
            'codigo'      => $request->codigo,
            'marca'       => $request->marca,
            'descripcion' => $request->descripcion,
            'categoria'   => $request->categoria,
            'stock'       => $request->stock,
            'almacen'     => $request->almacen,
            'foto'        => $fotoPath ?? null,
            'isActive'    => $request->isActive,
        ]);
        return response()->json($producto, 201);
    }

    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $request->validate([
            'codigo'       => 'required|string',
            'marca'        => 'required|string|max:100',
            'descripcion'  => 'required|string|max:255',
            'categoria'    => 'required|string|max:100',
            'stock'        => 'required|integer',
            'almacen'      => 'nullable|string|max:50',
            'isActive'     => 'nullable|boolean',
        ]);

        // Buscar el producto por su ID
        $producto = ProductosStock::find($id);

        // Verificar si el producto existe
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        // Actualizar los campos del producto
        $producto->codigo      = $request->codigo;
        $producto->marca       = $request->marca;
        $producto->descripcion = $request->descripcion;
        $producto->categoria   = $request->categoria;
        $producto->stock       = $request->stock;
        $producto->almacen     = $request->almacen;
        $producto->isActive    = $request->isActive;

        // Guardar los cambios en la base de datos
        $saved = $producto->save();

        // Verificar si el producto se guardó correctamente
        if (!$saved) {
            return response()->json(['error' => 'No se pudo actualizar el producto'], 500);
        }

        return response()->json($producto, 200);
    }

    public function destroy($id)
    {
        $producto           = ProductosStock::find($id);
        $producto->isActive = 0;
        $producto->save();
        return $producto;
    }
}
