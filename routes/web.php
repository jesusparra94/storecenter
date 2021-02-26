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
Route::get('/comocomprar', [ComoComprarController::class, 'index'])->name('comocomprar');
Route::get('/despacho', [DespachoController::class, 'index'])->name('despacho');
Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes');
Route::get('/registrarse', [ClientesController::class, 'registrarse'])->name('registrarse');
Route::post('/traercomunas', [ClientesController::class, 'traercomunas'])->name('traercomunas');
Route::post('/login', [ClientesController::class, 'login'])->name('login');

//Productos
Route::get('/listado/producto/{id}', [ProductoController::class, 'index'])->name('listado-producto');
Route::get('/producto/{id}', [ProductoController::class, 'detalles'])->name('detalle-producto');
Route::get('/producto/{id}/pdf', [ProductoController::class, 'generarpdf'])->name('generar-pdf');
Route::get('/cotizar/{id}', [ProductoController::class, 'cotizar'])->name('cotizar-producto');
Route::get('/cotizacion/generada/{id}', [CotizacionesController::class, 'cotizacionstatus'])->name('cotizacion-generada');
Route::post('/generar/cotizacion', [CotizacionesController::class, 'insert'])->name('generar-cotizacion');
Route::get('/novedades/{id}', [ProductoController::class, 'novedades'])->name('novedades-producto');
Route::post('/buscar', [ProductoController::class, 'buscarproducto'])->name('buscar-producto');

//Carrito
Route::post('car/add', [CarController::class, 'add'])->name('add-car');

//contacto
Route::get('/servicio-cliente', [ContactoController::class, 'index'])->name('formulario-contacto');
Route::post('/solicitud/enviada', [ContactoController::class, 'insert'])->name('generar-cotizacion');
//Route::get('car/add2/{id}', [CarController::class, 'add2'])->name('add-car2');

Route::group(['middleware'=>['login']], function(){

    // Route::get('/cuenta', function () {
    //     return view('cliente.micuenta');
    // });

Route::get('/cuenta', [ClientesController::class, 'micuenta'])->name('micuenta');
Route::get('/misdatos', [ClientesController::class, 'misdatos'])->name('misdatos');
Route::post('/logout', [ClientesController::class, 'logout'])->name('logout');
Route::get('/carrito', [CarController::class, 'carrito'])->name('carrito');
Route::post('car/delete', [CarController::class, 'deleteproducto'])->name('delete-producto');
Route::post('car/clear', [CarController::class, 'limpiarcar'])->name('limpiar-carrito');
Route::get('car/pdf', [CarController::class, 'generarpdf'])->name('pdf-carrito');

});
