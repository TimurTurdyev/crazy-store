<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function orders(): \Illuminate\Contracts\View\View
    {
        $orders = Order::paginate(12)->withQueryString();
        return view('catalog.customer.orders', compact('orders'));
    }

    public function orderDetail(Order $order): \Illuminate\Contracts\View\View
    {
        return view('catalog.customer.order', compact('order'));
    }
}
