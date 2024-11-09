<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\EmpresasController;
use App\Http\Controllers\Api\ClientesController;
use App\Http\Controllers\Api\TransportesController;
use App\Http\Controllers\Api\ProveedoresController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\UserPermissionController;
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

//Proceso Cotizacion
use App\Http\Controllers\Api\CotizacionController;
use App\Http\Controllers\Api\CotizacionProductosController;

//Dashboard
use App\Http\Controllers\Api\DashboardController;

//DASHBOARD
Route::prefix('dashboard')->group(function () {
    Route::get('OC_today', [DashboardController::class, 'OC_today']);
    Route::get('OC_WithoutFechaFactura', [DashboardController::class, 'OC_WithoutFechaFactura']);
    Route::get('cotizacionesToday', [DashboardController::class, 'cotizacionesHoy']);
});

//AUTH
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::get('me', [AuthController::class, 'me']);

//CONFIGURACION
Route::apiResource('users', UsersController::class);
Route::put('users/{userId}/permissions', [UserPermissionController::class, 'updatePermissions']);
Route::apiResource('clientes', ClientesController::class)->names('clientes');
Route::apiResource('transportes', TransportesController::class)->names('transportes');
Route::apiResource('proveedores', ProveedoresController::class)->names('proveedores');
///Contactos
Route::apiResource('contacto_clientes', ContactoClientesController::class);
Route::apiResource('contacto_proveedores', ContactoProveedoresController::class);
Route::apiResource('contacto_transportes', ContactoTransportesController::class);
//Empresa
Route::apiResource('empresas', EmpresasController::class)->names('empresas');
Route::get('empresas/{id}/logo', [EmpresasController::class, 'getLogo']);
Route::apiResource('catalogo_empresas', CatalogoEmpresasController::class);

//PROCESOS
//PROCESO VENTAS
Route::apiResource('contras', ContrasController::class);
Route::apiResource('seguimientos', SeguimientosController::class);

//OP
Route::apiResource('op_producto', OpProductoController::class);
Route::apiResource('orden_pedido', OrdenPedidoController::class);
Route::apiResource('seguimientos_op', SeguimientosController::class);

//PROCESO COTIZAZCION
Route::apiResource('cotizacion', CotizacionController::class);
Route::apiResource('cot_productos', CotizacionProductosController::class);
