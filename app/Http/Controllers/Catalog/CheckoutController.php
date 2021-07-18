<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Repositories\OrderInterface;
use Cart;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    protected OrderInterface $orderRepository;

    public function __construct(OrderInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index(): View
    {
        $cartCollection = Cart::getContent();
        return view('catalog.checkout.index', compact('cartCollection'));
    }

    public function placeOrder(Request $request)
    {
        // Before storing the order we should implement the
        // request validation which I leave it to you
        $order = $this->orderRepository->storeOrderDetails($request->all());

        dd($order);
    }

    public function complete(Request $request): View
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');

        $status = $this->payPal->completePayment($paymentId, $payerId);

        $order = Order::where('order_number', $status['invoiceId'])->first();
        $order->status = 'processing';
        $order->payment_status = 1;
        $order->payment_method = 'PayPal -'.$status['salesId'];
        $order->save();

        Cart::clear();
        return view('catalog.checkout.success', compact('order'));
    }
}
