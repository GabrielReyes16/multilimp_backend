<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\EmpresasController;
use App\Http\Controllers\Api\ClientesController;

//Empresas
Route::apiResource('empresas', EmpresasController::class);

//Clientes
Route::apiResource('clientes', ClientesController::class);
