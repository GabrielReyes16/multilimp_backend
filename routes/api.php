<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\EmpresasController;

Route::get('empresas', [EmpresasController::class, 'index']);
Route::post('empresas', [EmpresasController::class, 'store']);
Route::get('empresas/{id}', [EmpresasController::class, 'show']);
Route::put('empresas/{id}', [EmpresasController::class, 'update']);
Route::delete('empresas/{id}', [EmpresasController::class, 'destroy']);
