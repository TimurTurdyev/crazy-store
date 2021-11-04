<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\OrderRequest;
use App\Main\DeliveryService;
use App\Models\Order;
use App\Repositories\CartInterface;
use App\Repositories\OrderInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(CartInterface $cart): \Illuminate\Contracts\View\View
    {
        return view('catalog.order.create', compact('cart'));
    }

    public function store(OrderRequest $request, OrderInterface $order): \Illuminate\Http\RedirectResponse
    {
        $newOrder = $order->storeOrderDetails($request->all());
        return redirect()->route('order.completed', $newOrder);
    }

    public function completed(Order $order): \Illuminate\Contracts\View\View
    {
        return view('catalog.order.completed', compact('order'));
    }

    public function histories(Order $order): \Illuminate\Contracts\View\View
    {

        $histories = $order->histories()
            ->where('notify', 1)
            ->paginate(20)
            ->withQueryString();

        return view('catalog.partials.histories', compact('histories'));
    }

    public function deliveries($postal_code, Request $request): \Illuminate\Contracts\View\View
    {
        $deliveries = (new DeliveryService($postal_code))
            ->cdek()
            ->pochta()
            ->getDeliveries();

        if ($request->get('dd')) {
            dd($deliveries->toArray());
        }

        $request->session()->put('deliveries', $deliveries);

        return view('widget.deliveries', compact('postal_code', 'deliveries'));
    }
}
