<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderItemRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index(Order $order): \Illuminate\Contracts\View\View
    {
        return view('admin.order.product_edit', compact('order'));
    }

    public function update(OrderItemRequest $request, Order $order): \Illuminate\Http\RedirectResponse
    {
        $sub_total = 0;
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
                    $sub_total += $item->quantity * $item->price;
                    continue;
                }

                $prices[] = $item->id;

                $item->update($price);
                $sub_total += $item->quantity * $item->price;
            }

            $delete = $delete->whereNotIn('id', $prices);
        }

        foreach ($delete as $item) {
            $item->delete();
        }

        $total = $sub_total + $order->promo_value + $order->delivery_value;

        $order->update([
            'item_count' => $order->items->count(),
            'sub_total' => $sub_total,
            'total' => $total,
        ]);

        return redirect()->route('admin.order.edit', $order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\OrderItem $orderItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderItem $orderItem)
    {
        //
    }
}
