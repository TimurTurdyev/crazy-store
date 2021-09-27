<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderRequest;
use App\Main\DeliveryService;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Order $order): \Illuminate\Contracts\View\View
    {
        $orders = $order->orderByDesc('id')->paginate(12)->withQueryString();
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Order $order)
    {
        return view('admin.order.index', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('admin.order.create_edit', compact('order'));
    }

    public function update(OrderRequest $request, $id)
    {
        $order = Order::findOrFail($id);
        $data_update = $request->validated();

        $sub_total = $order->items->sum('price');

        $total = $sub_total + $order->promo_value + $order->delivery_value;

        $data_update = array_merge($data_update, [
            'item_count' => $order->items->count(),
            'sub_total' => $sub_total,
            'total' => $total,
        ]);

        $order->update($data_update);

        return response()->json(['code' => 201, 'order' => $order, 'items' => $order->items]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deliveries($postal_code, Request $request): \Illuminate\Contracts\View\View
    {
        $deliveries = (new DeliveryService($postal_code))
            ->cdekExtended()
            ->pochtaExtended()
            ->getDeliveries();

        if ($request->get('dd')) {
            dd($deliveries->toArray());
        }

        $request->session()->put('deliveries', $deliveries);

        return view('widget.deliveries_extended', compact('postal_code', 'deliveries'));
    }

    public function history(Order $order, Request $request): \Illuminate\Contracts\View\View
    {
        $request_data = $request->validate([
            'history.notify' => 'nullable|boolean',
            'history.message' => 'nullable|string'
        ]);

        if (isset($request_data['history']) && !empty($request_data['history']['message'])) {
            $order->histories()->create($request_data['history']);
        }

        $histories = $order->histories()->orderByDesc('id')->paginate(5)->withQueryString();

        return view('admin.order.history', compact('histories'));
    }

    public function products(Order $order)
    {

    }
}
