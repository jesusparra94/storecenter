<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductosCategoriasController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ComoComprarController;
use App\Http\Controllers\DespachoController;
use App\Http\Controllers\ClientesController;

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CotizacionesController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\TerminosController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [ProductosCategoriasController::class, 'index'])->name('inicio');
Route::get('/empresa', [EmpresaController::class, 'index'])->name('empresa');
Route::get('/terminos', [TerminosController::class, 'index'])->name('terminos');
Route::get('/comocomprar', [ComoComprarController::class, 'index'])->name('comocomprar');
Route::get('/despacho', [DespachoController::class, 'index'])->name('despacho');
Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes');
Route::get('/registrarse', [ClientesController::class, 'registrarse'])->name('registrarse');
Route::post('/procesar/registro', [ClientesController::class, 'procesarregistro'])->name('procesarregistro');
//Route::get('/registro-completado', [ClientesController::class, 'registrocompletado'])->name('registrocompletado');
Route::get('/registro/{id}', [ClientesController::class, 'registrostatus'])->name('registrostatus');
Route::post('/traercomunas', [ClientesController::class, 'traercomunas'])->name('traercomunas');
Route::post('/login', [ClientesController::class, 'login'])->name('login');

//Productos
Route::get('/listado/producto/{id}', [ProductoController::class, 'index'])->name('listado-producto');
Route::get('/producto/{id}', [ProductoController::class, 'detalles'])->name('detalle-producto');
Route::get('/producto/{id}/pdf', [ProductoController::class, 'generarpdf'])->name('generar-pdf');
Route::get('/cotizar/{id}', [ProductoController::class, 'cotizar'])->name('cotizar-producto');
Route::get('/cotizacion/generada/{id}', [CotizacionesController::class, 'cotizacionid'])->name('cotizacion-generada');
Route::post('/generar/cotizacion', [CotizacionesController::class, 'insert'])->name('generar-cotizacion');
Route::get('/novedades/{id}', [ProductoController::class, 'novedades'])->name('novedades-producto');
Route::get('/destacados/{id}', [ProductoController::class, 'destacados'])->name('destacados-producto');
Route::post('/buscar', [ProductoController::class, 'buscarproducto'])->name('buscar-producto');

//contacto
Route::get('/contacto', [ContactoController::class, 'index'])->name('formulario-contacto');
Route::post('/enviar/solicitud', [ContactoController::class, 'insert'])->name('enviar-solicitud');
Route::get('/solicitud/enviada', [ContactoController::class, 'cotizacioncontacto'])->name('solicitud-enviada');
//Route::get('car/add2/{id}', [CarController::class, 'add2'])->name('add-car2');

Route::group(['middleware'=>['login']], function(){

    // Route::get('/cuenta', function () {
    //     return view('cliente.micuenta');
    // });

Route::get('/cuenta', [ClientesController::class, 'micuenta'])->name('micuenta');
Route::get('/misdatos', [ClientesController::class, 'misdatos'])->name('misdatos');
Route::post('/logout', [ClientesController::class, 'logout'])->name('logout');
Route::get('/pedido/{id}', [ClientesController::class, 'detalles'])->name('detalles');

//Carrito
Route::post('car/add', [CarController::class, 'add'])->name('add-car');
Route::get('/carrito', [CarController::class, 'carrito'])->name('carrito');
Route::post('car/delete', [CarController::class, 'deleteproducto'])->name('delete-producto');
Route::post('car/clear', [CarController::class, 'limpiarcar'])->name('limpiar-carrito');
Route::get('car/pdf', [CarController::class, 'generarpdf'])->name('pdf-carrito');
//FinalizarCompra (Cotización)
Route::get('/finalizar-compra', [CarController::class, 'insert'])->name('finalizar-compra');
Route::get('/pedido-generado', [CarController::class, 'pedidogenerado'])->name('pedido-generado');

});
