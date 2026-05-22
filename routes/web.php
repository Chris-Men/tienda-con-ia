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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

Route::post('/guardar-estampado-local', function (Request $request) {
    $urlIa = $request->input('url_imagen');

    if (!$urlIa) {
        return response()->json(['error' => 'No se proporcionó una URL'], 400);
    }

    try {
        // 1. Descargar los bytes de la imagen desde internet
        $response = Http::timeout(30)->get($urlIa);

        if ($response->failed()) {
            return response()->json(['error' => 'No se pudo descargar la imagen original'], 500);
        }

        // 2. Generar un nombre único para el archivo físico PNG
        $nombreArchivo = 'diseno_ia_' . uniqid() . '.png';

        // 3. Crear la carpeta pública si no existe y guardar el archivo en public/storage/estampados/
        $rutaCarpeta = public_path('storage/estampados');
        if (!file_exists($rutaCarpeta)) {
            mkdir($rutaCarpeta, 0755, true);
        }

        file_put_contents($rutaCarpeta . '/' . $nombreArchivo, $response->body());

        // 4. Retornar la URL local de tu servidor Laragon
        return response()->json([
            'success' => true,
            'url_local' => asset('storage/estampados/' . $nombreArchivo),
            'archivo' => $nombreArchivo
        ]);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
})->name('guardar.estampado.local');

// === NUEVA RUTA PARA LA GENERACIÓN DE IA ===
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Http;

// Route::post('/generate-image', function (Request $request) {

//     $prompt = $request->prompt;

//     $response = Http::withHeaders([
//         'Authorization' => 'Bearer ' . env('HF_TOKEN'),
//     ])
//         ->timeout(180)
//         ->post(
//             'https://api-inference.huggingface.co/models/runwayml/stable-diffusion-v1-5',
//             [
//                 'inputs' => $prompt,
//                 'options' => [
//                     'wait_for_model' => true
//                 ]
//             ]
//         );

//     // Detectar si vino JSON de error
//     $contentType = $response->header('Content-Type');

//     if (str_contains($contentType, 'application/json')) {

//         return response()->json([
//             'huggingface_response' => $response->json()
//         ], 500);
//     }

//     return response()->json([
//         'headers' => $response->headers(),
//         'body' => $response->body(),
//         'status' => $response->status()
//     ]);
// });
