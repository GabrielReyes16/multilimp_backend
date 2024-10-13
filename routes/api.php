<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\EmpresasController;
use App\Http\Controllers\Api\ClientesController;
use App\Http\Controllers\Api\TransportesController;
use App\Http\Controllers\Api\ProveedoresController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\RolesController;
//Proceso ventas
use App\Http\Controllers\Api\ContrasController;
use App\Http\Controllers\Api\ContactoClientesController;
use App\Http\Controllers\Api\CatalogoEmpresasController;
use App\Http\Controllers\Api\SeguimientosController;
//Proceso OP
use App\Http\Controllers\Api\ContactoProveedoresController;
use App\Http\Controllers\Api\ContactoTransportesController;
use App\Http\Controllers\Api\OpProductoController;
use App\Http\Controllers\Api\OrdenPedidoController;


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

//PROCESO VENTAS
//Contras
Route::apiResource('contras', ContrasController::class);

//ContactoClientes
Route::apiResource('contacto_clientes', ContactoClientesController::class);

//CatalogoEmpresas
Route::apiResource('catalogo_empresas', CatalogoEmpresasController::class);

//Seguimientos
Route::apiResource('seguimientos', SeguimientosController::class);

//PROCESO OP
//ContactoProveedores
Route::apiResource('contacto_proveedores', ContactoProveedoresController::class);

//ContactoTransportes
Route::apiResource('contacto_transportes', ContactoTransportesController::class);

//OpProveedores
Route::apiResource('op_producto', OpProductoController::class);

//OrdenPedidos
Route::apiResource('orden_pedido', OrdenPedidoController::class);

//SeguimientoOp
Route::apiResource('seguimientos_op', SeguimientosController::class);
