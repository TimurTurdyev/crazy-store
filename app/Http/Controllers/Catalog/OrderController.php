<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Repositories\CartInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private const INCLUDES = ['cdek' => 'widget.cdek', 'pochta' => 'widget.pochta'];

    public function index(CartInterface $cart)
    {
        return view('catalog.order.index', compact('cart'));
    }

    public function include($shipping)
    {
        $include_shipping = self::INCLUDES[$shipping] ?? '';
        $active = $shipping;
        return view('catalog.order.index', compact('include_shipping', 'active'));
    }
}
