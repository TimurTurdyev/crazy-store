<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderRequest;
use App\Main\DeliveryService;
use App\Models\Order;
use App\Models\OrderTotal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index(Order $order): \Illuminate\Contracts\View\View
    {
        $orders = $order->orderByDesc('id')->with('histories')->paginate(12)->withQueryString();
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
        $order->update($request->validated());
        $order->totals()->delete();

        $sub_total = $order->items->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        $totals = collect();

        if ($request_totals = $request->get('totals')) {
            foreach ($request_totals as $total) {
                if (in_array($total['code'], ['subtotal', 'total'])) {
                    continue;
                }
                $totals->push(new OrderTotal($total));
            }
        }

        if (!$totals->firstWhere('code', 'subtotal')) {
            $totals->push(new OrderTotal([
                'code' => 'subtotal',
                'title' => 'Всего',
                'value' => $sub_total,
                'sort_order' => 0,
            ]));
        }

        if (!$totals->firstWhere('code', 'promo')) {
            $totals->push(new OrderTotal([
                'code' => 'promo',
                'title' => 'Скидка',
                'value' => 0,
                'sort_order' => 1,
            ]));
        }

        if ($totals->firstWhere('code', 'promo')->value > 0) {
            $totals->firstWhere('code', 'promo')->value = -(int)$totals->firstWhere('code', 'promo')->value;
        }

        if (!$totals->firstWhere('code', 'delivery')) {
            $totals->push(new OrderTotal([
                'code' => 'delivery',
                'title' => 'Доставка',
                'value' => 0,
                'sort_order' => 10,
            ]));
        }

        if (!$totals->firstWhere('code', 'total')) {
            $totals->push(new OrderTotal([
                'code' => 'total',
                'title' => 'Итого',
                'value' => $totals->sum('value'),
                'sort_order' => 99,
            ]));
        }

        $order->totals()->delete();
        $order->totals()->saveMany($totals);


        if ($request->ajax()) {
            return response()->json(['code' => 201, 'order' => $order, 'items' => $order->items, 'totals' => $totals]);
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
            'history.message' => 'nullable|string',
            'history.status' => ['nullable', 'integer', Rule::in(array_keys(config('main.order')))]
        ]);

        $request_data = $request_data['history'] ?? [];

        if (empty($request_data['message'])) {
            $request_data['message'] = '-';
        }

        if (empty($request_data['status'])) {
            $request_data['status'] = 0;
        }

        $order->histories()->create($request_data);

        $histories = $order->histories()
            ->paginate(20)
            ->withQueryString();

        $selected = $order->histories()->orderByDesc('id')->first()?->status;

        return view('admin.order.history', compact('request_data', 'selected', 'order', 'histories'));
    }
}
