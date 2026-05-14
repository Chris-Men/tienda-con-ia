<?php

namespace App\Http\Controllers;

use App\Models\Detallespedido;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function mostrarCart()
    {
        $productos = Producto::all(); // Pagina cada 5 registros
        return view('cart', compact('productos'));
    }

    public function mostrarCheckout()
    {
        return view('checkout');
    }

    public function finalizarPedido(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;


        $carritoJSON = $request->carrito;
        $carrito = json_decode($carritoJSON, true);
        
        $total = 0;

        foreach ($carrito as $producto) {
            // ... (resto del código)

            // Calcular subtotal y agregar al total
            $subtotal = $producto['cantidad'] * $producto['precio'];
            $total += $subtotal;

        }

        $pedido = new Pedido();
        $pedido->fecha_pedido = now();
        $pedido->cliente_id = $userId;
        $pedido->total = $total;
        $pedido->estado = 0;
        $pedido->save();

        if (is_array($carrito)) {
            foreach ($carrito as $producto) {
                $detallespedido = new Detallespedido();
                $detallespedido->pedido_id = $pedido->id;
                $detallespedido->producto_id = $producto['id'];
                $detallespedido->cantidad = $producto['cantidad'];

                // Calcular el subtotal (cantidad * precio)
                $subtotal = $producto['cantidad'] * $producto['precio'];
                $detallespedido->subtotal = $subtotal;

                $detallespedido->save();

                // Actualizar el stock en la tabla `productos`
                $productoModel = Producto::find($producto['id']);
                if ($productoModel) {
                    $nuevoStock = $productoModel->stock - $producto['cantidad'];
                    $productoModel->stock = $nuevoStock;
                    $productoModel->save();
                }
            }
        }

        return redirect()->route('confirmar');
    }

    public function confirmar()
    {
        return view('confirmado');
    }
}
