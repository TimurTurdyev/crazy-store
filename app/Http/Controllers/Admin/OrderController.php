<?php

namespace App\Http\Controllers\Admin;

use App\Filters\OrderHistoryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderRequest;
use App\Main\DeliveryService;
use App\Main\Project\Order\HistoryProject;
use App\Main\Project\Order\StatusProject;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index(Order $order): \Illuminate\Contracts\View\View
    {
        $orders = $order->orderByDesc('id')->paginate(12)->withQueryString();
        return view('admin.order.index', compact('orders'));
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        $order = new Order();
        return view('admin.order.create_edit', compact('order'));
    }

    public function store(OrderRequest $request): \Illuminate\Http\RedirectResponse
    {
        $order = new Order($request->validated());
        $order->order_code = Str::uuid();
        $order->item_count = 0;
        $order->sub_total = 0;
        $order->total = 0;
        $order->save();

        return redirect()->route('admin.order.edit', $order);
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

    public function edit(Order $order): \Illuminate\Contracts\View\View
    {
        return view('admin.order.create_edit', compact('order'));
    }

    public function update(OrderRequest $request, Order $order): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
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
            'history.code' => 'nullable|string',
            'history.notify' => 'nullable|boolean',
            'history.message' => 'nullable|string',
            'history.status' => ['nullable', 'string', Rule::in(['pending', 'processing', 'complete', 'decline'])]
        ]);

        $request_data = $request_data['history'] ?? [];

        if (!empty($request_data['message'])) {
            if (empty($request_data['status'])) {
                $request_data['status'] = 'pending';
            }

            $order->histories()->create($request_data);
        }

        $histories = $order->histories()
            ->getModel()
            ->filter(new OrderHistoryFilter($request_data))
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('admin.order.history', compact('request_data', 'order', 'histories'));
    }
}
