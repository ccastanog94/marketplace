<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('productos');
});

Route::get('/productos', [ProductController::class, 'index']);
Route::get('/productos', [ProductoController::class, 'index']);

Route::post('/carrito/agregar/{id}', function () {
    return back()->with('mensaje', 'Producto agregado (simulado)');
})->name('carrito.agregar');
