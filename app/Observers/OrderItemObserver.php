<?php

namespace App\Observers;

use App\Models\OrderItem;
use App\Models\VariantPrice;
use Illuminate\Support\Facades\DB;

class OrderItemObserver
{
    public bool $afterCommit = false;

    /**
     * Handle the OrderItem "created" event.
     *
     * @param \App\Models\OrderItem $orderItem
     * @return void
     */
    public function created(OrderItem $orderItem)
    {
        VariantPrice::where('id', $orderItem->price_id)->decrement('quantity', $orderItem->quantity);
    }

    /**
     * Handle the OrderItem "updated" event.
     *
     * @param \App\Models\OrderItem $orderItem
     * @return void
     */
    public function updated(OrderItem $orderItem)
    {
        if ($orderItem->wasChanged('quantity')) {
            $original_quantity = $orderItem->getOriginal('quantity');
            $new_quantity = $orderItem->quantity;

            if ($original_quantity > $new_quantity) {        // Если больше, то вернем на склад
                VariantPrice::where('id', $orderItem->price_id)->increment('quantity', $original_quantity - $new_quantity);
            } else if ($original_quantity < $new_quantity) { // Если меньше, то вычтем со склада
                VariantPrice::where('id', $orderItem->price_id)->decrement('quantity', $new_quantity - $original_quantity);
            }
        }
    }

    /**
     * Handle the OrderItem "deleted" event.
     *
     * @param \App\Models\OrderItem $orderItem
     * @return void
     */
    public function deleted(OrderItem $orderItem)
    {
        VariantPrice::where('id', $orderItem->price_id)->increment('quantity', $orderItem->quantity);
    }

    /**
     * Handle the OrderItem "restored" event.
     *
     * @param \App\Models\OrderItem $orderItem
     * @return void
     */
    public function restored(OrderItem $orderItem)
    {
        //
    }

    /**
     * Handle the OrderItem "force deleted" event.
     *
     * @param \App\Models\OrderItem $orderItem
     * @return void
     */
    public function forceDeleted(OrderItem $orderItem)
    {
        //
    }
}
