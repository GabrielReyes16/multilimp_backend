<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\EmpresasController;
use App\Http\Controllers\Api\ClientesController;
use App\Http\Controllers\Api\TransportesController;
use App\Http\Controllers\Api\ProveedoresController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\ContrasController;
use App\Http\Controllers\Api\ContactoClientesController;
use App\Http\Controllers\Api\CatalogoEmpresasController;
use App\Http\Controllers\Api\SeguimientosController;

//Empresas
Route::apiResource('empresas', EmpresasController::class);

//Clientes
Route::apiResource('clientes', ClientesController::class);

//Transportes
Route::apiResource('transportes', TransportesController::class);

//Proveedores
Route::apiResource('proveedores', ProveedoresController::class);

//Users
Route::apiResource('users', UsersController::class);

//Roles
Route::apiResource('roles', RolesController::class);

//Contras
Route::apiResource('contras', ContrasController::class);

//ContactoClientes
Route::apiResource('contacto_clientes', ContactoClientesController::class);

//CatalogoEmpresas
Route::apiResource('catalogo_empresas', CatalogoEmpresasController::class);

//Seguimientos
Route::apiResource('seguimientos', SeguimientosController::class);
