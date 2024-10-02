<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
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
            'ruc' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'cod_unidad' => 'required|string|max:255',
            'departamento' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'distrito' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
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
    public function show(Cliente $cliente)
    {
        return response()->json($cliente);
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
            'ruc' => 'sometimes|required|string|max:255',
            'razon_social' => 'sometimes|required|string|max:255',
            'cod_unidad' => 'sometimes|required|string|max:255',
            'departamento' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'distrito' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
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
        $cliente->delete();

        return response()->json(null, 204);
    }
}
