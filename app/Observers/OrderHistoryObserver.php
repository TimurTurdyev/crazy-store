<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderHistory;
use App\Repositories\TotalsRepository;

class OrderHistoryObserver
{
    /**
     * Handle the OrderHistory "created" event.
     *
     * @param \App\Models\OrderHistory $orderHistory
     * @return void
     */
    public function created(OrderHistory $orderHistory)
    {
        if ((int)$orderHistory->status === (int)config('main.order_returned')) {
            $order = Order::find($orderHistory->order_id);

            foreach ($order->items as $item) {
                $item->quantity = 0;
                $item->save();
            }

            $totals = new TotalsRepository($order, $order->totals->toArray());
            $totals->apply();
        }
    }

    /**
     * Handle the OrderHistory "updated" event.
     *
     * @param \App\Models\OrderHistory $orderHistory
     * @return void
     */
    public function updated(OrderHistory $orderHistory)
    {

    }

    /**
     * Handle the OrderHistory "deleted" event.
     *
     * @param \App\Models\OrderHistory $orderHistory
     * @return void
     */
    public function deleted(OrderHistory $orderHistory)
    {
        //
    }

    /**
     * Handle the OrderHistory "restored" event.
     *
     * @param \App\Models\OrderHistory $orderHistory
     * @return void
     */
    public function restored(OrderHistory $orderHistory)
    {
        //
    }

    /**
     * Handle the OrderHistory "force deleted" event.
     *
     * @param \App\Models\OrderHistory $orderHistory
     * @return void
     */
    public function forceDeleted(OrderHistory $orderHistory)
    {
        //
    }
}
