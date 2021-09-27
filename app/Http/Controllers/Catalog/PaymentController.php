<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\PaymentInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function instruction(Order $order, PaymentInterface $payment): \Illuminate\Http\JsonResponse
    {
        return response()->json($payment->message($order));
    }
}
