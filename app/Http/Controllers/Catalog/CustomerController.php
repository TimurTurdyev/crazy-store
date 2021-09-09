<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function orders(Order $order, Request $request): \Illuminate\Contracts\View\View
    {
        $orders = $order->where('user_id', auth()->id())->orderByDesc('id')->paginate(12)->withQueryString();
        return view('catalog.customer.orders', compact('orders'));
    }

    public function orderDetail(Order $order): \Illuminate\Contracts\View\View
    {
        abort_if($order->user_id !== auth()->id(), 404, 'Заказ не найден');

        return view('catalog.customer.order', compact('order'));
    }
}
