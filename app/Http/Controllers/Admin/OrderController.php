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

    public function update(OrderRequest $request, $id): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $order = Order::findOrFail($id);

        $sub_total = $order->items->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        $promo_value = $request->get('promo_value', $order->promo_value);

        if ($promo_value > 0) {
            $promo_value = -($promo_value);
            $request->merge(['promo_value' => $promo_value]);
        }

        $total = $sub_total + $promo_value + $order->delivery_value;

        $data_update = array_merge($request->validated(), [
            'item_count' => $order->items->count(),
            'sub_total' => $sub_total,
            'total' => $total,
        ]);

        $data_update['promo_value'] = $promo_value;

        $order->update($data_update);

        if ($request->ajax()) {
            return response()->json(['code' => 201, 'order' => $order, 'items' => $order->items]);
        }

        return redirect()->route('admin.order.edit', $order);
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
}
