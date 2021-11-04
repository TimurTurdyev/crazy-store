<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function orders(Order $order, Request $request): \Illuminate\Contracts\View\View
    {
        $user_id = auth()->id();

        if (auth()->user()->isAdmin() === 1 && session('customer_id')) {
            $user_id = session('customer_id');
        }

        $orders = $order->where('user_id', $user_id)
            ->with('items')
            ->orderByDesc('id')
            ->paginate(12)->withQueryString();

        return view('catalog.customer.orders', compact('orders'));
    }

    public function orderDetail(Order $order): \Illuminate\Contracts\View\View
    {
        $user_id = auth()->id();

        if (auth()->user()->isAdmin() === 1) {
            $user_id = $order->user_id;
        }

        abort_if($order->user_id !== $user_id, 404, 'Заказ не найден');

        return view('catalog.customer.order', compact('order'));
    }


}
