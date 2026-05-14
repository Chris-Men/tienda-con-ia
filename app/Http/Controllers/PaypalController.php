<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Detallespedido;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    public function createpaypal()
    {
        // return view('paypal_view');
        return view('checkout');
    }

    public function processPaypal(Request $request)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener totalVenta desde el formulario
        $totalVenta = $request->input('totalVenta');

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('processSuccess'),
                "cancel_url" => route('processCancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $totalVenta
                    ]
                ]
            ]
        ]);

        // Decodificar el carrito JSON antes de almacenarlo en la sesión
        $carritoJSON = $request->carrito;
        $carrito = json_decode($carritoJSON, true);

        // Guardar información relevante en la sesión
        session([
            'carrito' => $carrito,
            'totalVenta' => $totalVenta,
        ]);

        // Redirigir al usuario a la página de aprobación de PayPal
        foreach ($response['links'] as $links) {
            if ($links['rel'] == 'approve') {
                return redirect()->away($links['href']);
            }
        }

        return redirect()
            ->route('createpaypal')
            ->with('error', 'Something went wrong.');
    }

    public function processSuccess(Request $request)
    {
        // Obtener información de la sesión
        $carrito = session('carrito');
        $totalVenta = session('totalVenta');

        // Obtener el usuario autenticado
        $user = Auth::user();

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            // Crear un nuevo pedido
            $pedido = new Pedido();
            $pedido->fecha_pedido = now();
            $pedido->cliente_id = $user->id;
            $pedido->total = $totalVenta;
            $pedido->estado = 0;
            $pedido->save();

            // Obtener el ID del pedido después de guardarlo
            $pedidoId = $pedido->id;

            // Crear Detallespedido y actualizar el stock
            foreach ($carrito as $producto) {
                $detallespedido = new Detallespedido();
                $detallespedido->pedido_id = $pedidoId;
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

            // Después de completar la transacción, establece un mensaje en la sesión
            $request->session()->flash('clearCart', true);

            return redirect()
                ->route('confirmar')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('createpaypal')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function processCancel(Request $request)
    {
        return redirect()
            ->route('createpaypal')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
