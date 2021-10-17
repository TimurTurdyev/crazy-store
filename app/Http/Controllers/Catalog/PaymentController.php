<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Repositories\PaymentInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function instruction(Order $order, PaymentInterface $payment): \Illuminate\Http\JsonResponse
    {
        return response()->json($payment->message($order));
    }

    public function change(Order $order, Request $request, PaymentInterface $payment): \Illuminate\Http\RedirectResponse
    {
        $code = $request->get('payment_code', '');
        $payments = array_keys($order->payments);

        abort_if(!in_array($code, $payments), 404);

        $order->payment_code = $code;

        $message = $payment->message($order);

        $order->payment_instruction = $message['message'];

        $order->save();

        $order->histories()->save(new OrderHistory([
            'notify' => 0,
            'status' => 40,
            'message' => 'Клиент изменил способ оплаты',
        ]));

        return redirect()->back('302');
    }
}
