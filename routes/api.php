<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\EmpresasController;
use App\Http\Controllers\Api\ClientesController;
use App\Http\Controllers\Api\TransportesController;
use App\Http\Controllers\Api\ProveedoresController;
use App\Http\Controllers\Api\BancoProveedoresController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\UserPermissionController;
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

//Proceso Tesoreria
use App\Http\Controllers\Api\TesoreriaController;

//Proceso Facturacion
use App\Http\Controllers\Api\FacturacionController;

//Dashboard
use App\Http\Controllers\Api\DashboardController;

//Cobranzas
use App\Http\Controllers\Api\GestionCobranzaController;


//Stock de productos
use App\Http\Controllers\Api\ProductoStockController;

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

Route::apiResource('users', UsersController::class);
Route::put('users/{userId}/permissions', [UserPermissionController::class, 'updatePermissions']);
Route::post('users/{id}/upload-photo', [UsersController::class, 'uploadPhoto']);
Route::apiResource('clientes', ClientesController::class)->names('clientes');
Route::apiResource('transportes', TransportesController::class)->names('transportes');
Route::apiResource('proveedores', ProveedoresController::class)->names('proveedores');
Route::apiResource('banco_proveedores', BancoProveedoresController::class);
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
Route::post('preProcess', [SeguimientosController::class, 'preProcess']);

//OP
Route::apiResource('op_producto', OpProductoController::class);
Route::apiResource('orden_pedido', OrdenPedidoController::class);
Route::apiResource('seguimientos_op', SeguimientosController::class);

//PROCESO COTIZAZCION
Route::apiResource('cotizacion', CotizacionController::class);
Route::apiResource('cot_productos', CotizacionProductosController::class);

//TESORERIA
Route::prefix('tesoreria')->group(function () {
    //Listar todos los registros de tesorería
    Route::get('/', [TesoreriaController::class, 'index']);

    // Registrar un nuevo registro de tesorería
    Route::post('/registro', [TesoreriaController::class, 'registro']);

    // Obtener un registro de tesorería por ID
    Route::get('/{id}', [TesoreriaController::class, 'show']);

    // Actualizar un registro de tesorería
    Route::put('/{tesoreria}', [TesoreriaController::class, 'update']);
});

//FACTURACION
Route::prefix('facturacion')->group(function () {
    Route::get('/', [FacturacionController::class, 'index']);
    Route::get('/{id}', [FacturacionController::class, 'show']);
    Route::get('/actual/{id}', [FacturacionController::class, 'actual']);
    Route::post('/', [FacturacionController::class, 'store']);
    Route::put('/{facturacion}', [FacturacionController::class, 'cambiarEstado']);
});

//Historial de gestiones(cobranzas)
Route::apiResource('cobranzas', GestionCobranzaController::class);
Route::get('cobranzas/{id}/downloaddoc', [GestionCobranzaController::class, 'downloadDocumento']);

//Stock de productos
Route::apiResource('stock', ProductoStockController::class);
