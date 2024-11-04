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

use App\Http\Middleware\CheckPermissions;


//Users
Route::apiResource('users', UsersController::class);
//Permisos del usuario
Route::put('users/{userId}/permissions', [UserPermissionController::class, 'updatePermissions']);

//Autenticacion
// Autenticacion
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);



//Configuracion
//Empresas
    Route::apiResource('empresas', EmpresasController::class)->names('empresas');
    Route::apiResource('clientes', ClientesController::class)->names('clientes');
    Route::apiResource('transportes', TransportesController::class)->names('transportes');
    Route::apiResource('proveedores', ProveedoresController::class)->names('proveedores');

//Transportes


//PROCESOS
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


//PROCESO COTIZAZCION
//Cotizacion
Route::apiResource('cotizacion', CotizacionController::class);

//Cotizacion Productos
Route::apiResource('cot_productos', CotizacionProductosController::class);
