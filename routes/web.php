<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaypalController;



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
    return view('welcome');
});

Auth::routes();

// Route::get('productos/pdf', [ProductoController::class, 'pdf'])->name('productos.pdf');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home_admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home_admin');
Route::get('/home_user', [App\Http\Controllers\HomeController::class, 'index'])->name('home_user');

Route::get('productos/pdf', [App\Http\Controllers\ProductoController::class, 'pdf'])->name('productos.pdf');
Route::get('categorias/pdf', [App\Http\Controllers\CategoriaController::class, 'pdf'])->name('categorias.pdf');

Route::resource('clientes', \App\Http\Controllers\ClienteController::class);
Route::resource('pedidos', \App\Http\Controllers\PedidoController::class);
Route::resource('productos', \App\Http\Controllers\ProductoController::class);
Route::resource('categorias', \App\Http\Controllers\CategoriaController::class);
Route::resource('detallespedidos', \App\Http\Controllers\DetallespedidoController::class);

Route::get('/cart', function () {
    return view('cart.index');
});

// Rutas del carro
Route::get('/cart', [CartController::class, 'mostrarCart'])->name('cart');
Route::get('/checkout', [CartController::class, 'mostrarCheckout'])->name('checkout');
// Route::post('/finalizar-compra', [CartController::class, 'finalizarPedido'])->name('finalizar.compra');
Route::get('/confirmar', [CartController::class, 'confirmar'])->name('confirmar');

// Rutas de paypal
Route::get('createpaypal', [PaypalController::class, 'createpaypal'])->name('createpaypal');
Route::get('processPaypal', [PaypalController::class, 'processPaypal'])->name('processPaypal');
Route::get('processSuccess', [PaypalController::class, 'processSuccess'])->name('processSuccess');
Route::get('processCancel', [PaypalController::class, 'processCancel'])->name('processCancel');

