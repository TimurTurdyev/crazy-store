<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderItemRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\TotalsRepository;

class OrderItemController extends Controller
{
    public function index(Order $order): \Illuminate\Contracts\View\View
    {
        return view('admin.order.product_edit', compact('order'));
    }

    public function update(OrderItemRequest $request, Order $order): \Illuminate\Http\RedirectResponse
    {
        $delete = $order->items;

        if ($request->prices) {
            $prices = [];

            foreach ($request->prices as $id => $price) {

                if ($price['quantity'] < 1) continue;

                $item = $order->items->firstWhere('id', $id);

                if ($item === null) {  // Если не нашли в заказе, то создадим и вычтем со склада

                    $item = new OrderItem(
                        array_merge(['order_id' => $order->id], $price)
                    );

                    $item->save();
                    continue;
                }

                $prices[] = $item->id;

                $item->update($price);
            }

            $delete = $delete->whereNotIn('id', $prices);
        }

        foreach ($delete as $item) {
            $item->delete();
        }

        $totals = new TotalsRepository($order, $order->totals->toArray());
        $totals->apply();

        return redirect()->route('admin.order.edit', $order);
    }
}
