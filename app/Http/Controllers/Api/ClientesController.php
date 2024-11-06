<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    //Constantes
    private const  SOME_REQ_STRING_255 = 'sometimes|required|string|max:255';
    private const  REQ_STRING_255 ='required|string|max:255';
    private const NULLABLE_STRING_255 = 'nullable|string|max:255';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::with('contactos')->get();
        return response()->json($clientes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ruc' => self::REQ_STRING_255,
            'razon_social' => self::REQ_STRING_255,
            'cod_unidad' => self::REQ_STRING_255,
            'departamento' => self::NULLABLE_STRING_255,
            'provincia' => self::NULLABLE_STRING_255,
            'distrito' => self::NULLABLE_STRING_255,
            'direccion' => self::NULLABLE_STRING_255,
            'estado' => 'nullable|boolean',
        ]);

        $cliente = Cliente::create($validatedData);

        return response()->json($cliente, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::with('contactos') -> find($id);

        if(!$cliente){
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        return response() -> json($cliente, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $validatedData = $request->validate([
            'ruc' => self::SOME_REQ_STRING_255,
            'razon_social' => self::SOME_REQ_STRING_255,
            'cod_unidad' => self::SOME_REQ_STRING_255,
            'departamento' => self::NULLABLE_STRING_255,
            'provincia' => self::NULLABLE_STRING_255,
            'distrito' => self::NULLABLE_STRING_255,
            'direccion' => self::NULLABLE_STRING_255,
            'estado' => 'nullable|boolean',
        ]);

        $cliente->update($validatedData);

        return response()->json($cliente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->estado = 0; // Cambia el estado a inactivo (eliminación lógica)
        $cliente->save();

        return response()->json(['message' => 'Cliente desactivado exitosamente'], 200);
    }

}
