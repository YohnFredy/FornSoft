<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Order::query()->where('user_id', $user->id);

        // Verifica si se envió un status en la solicitud
        if (request('status')) {
            $status = request('status');

            // Si el status es 2, busca los que tienen status 2 o 3
            if ($status == 2) {
                $orders->whereIn('status', [2, 3]);
            }
            // Si el status es 6, busca los que tienen status >= 6
            elseif ($status == 6) {
                $orders->where('status', '>=', 6);
            }
            // Para otros casos, solo busca el status específico
            else {
                $orders->where('status', $status);
            }
        }

        // Obtener los resultados
        $orders = $orders->get();

        // Contadores de las órdenes según su estado
        $pendientes = Order::where('status', 1)
            ->where('user_id', $user->id)
            ->count();
        $recibido = Order::whereIn('status', [2, 3])
            ->where('user_id', $user->id)
            ->count();
        $enviado = Order::where('status', 4)
            ->where('user_id', $user->id)
            ->count();
        $entregado = Order::where('status', 5)
            ->where('user_id', $user->id)
            ->count();
        $anulado = Order::where('status', '>=', 6)
            ->where('user_id', $user->id)
            ->count();

        // Retornar la vista con los datos compactados
        return view('orders.index', compact('orders', 'pendientes', 'recibido', 'enviado', 'entregado', 'anulado'));
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function boldCheckout(Order $order)
    {
        $apiKey = config('services.bold.api_key');
        $secretKey = config('services.bold.secret_key');
        $currency = 'COP';
        $amount = (int) $order->total;
        $orderId = $order->public_order_number;

        $boldHashString = "{$orderId}{$amount}{$currency}{$secretKey}";
        $boldIntegritySignature = hash('sha256', $boldHashString);

        // Calcular fecha de expiración (ejemplo: 1 hora después de la solicitud)
        $expirationTimestamp = now()->addHour()->timestamp * 1_000_000_000; // Convertir a nanosegundos

        $tax = $order->tax_amount;

        $boldCheckoutConfig = [
            'orderId' => $orderId,
            'currency' => $currency,
            'amount' => $amount,
            'apiKey' => $apiKey,
            'integritySignature' => $boldIntegritySignature,
            'description' => "Pago",
            'tax' => $order->tax_amount,

            /* 'tax' => json_encode(['vat' => $order->tax_amount]), */
            'redirectionUrl' => config('services.bold.redirect_url'),
            'expiration-date' => $expirationTimestamp,
        ];

        return view('orders.checkout-bold', compact('order', 'boldCheckoutConfig'));
    }

    public function wompiCheckout(Order $order)
    {
        $reference = $order->public_order_number;
        $amount = intval($order->total * 100); // Convertir a centavos
        $currency = 'COP';
        $expiration = now()->addMinutes(30)->toISOString(); // Expira en 30 min (puedes cambiarlo)

        // Obtener la clave de integridad desde config/services.php
        $secretKey = Config::get('services.wompi.integrity_key');

        // Construcción de la cadena para el hash
        $dataString = $reference . $amount . $currency . $expiration . $secretKey;

        // Generar la firma de integridad con SHA256
        $signature = hash('sha256', $dataString);

        return view('orders.checkout-wompi', compact('order', 'reference', 'amount', 'currency', 'expiration', 'signature'));
    }
}
