<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderTotal;

class TotalsRepository
{
    private Order $order;
    private int $subtotal = 0;
    private \Illuminate\Support\Collection $totals;

    public function __construct(Order $order, $totals = [])
    {
        $this->totals = collect();
        $this->order = $order;

        $this->subtotal = $this->order->items()->get()->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        foreach ($totals as $total) {
            if (in_array($total['code'], ['subtotal', 'total'])) {
                continue;
            }

            $this->totals->push(new OrderTotal($total));
        }

        if (!$this->totals->firstWhere('code', 'subtotal')) {
            $this->totals->push(new OrderTotal([
                'code' => 'subtotal',
                'title' => 'Всего',
                'value' => $this->subtotal,
                'sort_order' => 0,
            ]));
        }

        if (!$this->totals->firstWhere('code', 'promo')) {
            $this->totals->push(new OrderTotal([
                'code' => 'promo',
                'title' => 'Скидка',
                'value' => 0,
                'sort_order' => 1,
            ]));
        }

        if ($this->totals->firstWhere('code', 'promo')->value > 0) {
            $this->totals->firstWhere('code', 'promo')->value = -(int)$this->totals->firstWhere('code', 'promo')->value;
        }

        if (!$this->totals->firstWhere('code', 'delivery')) {
            $this->totals->push(new OrderTotal([
                'code' => 'delivery',
                'title' => 'Доставка',
                'value' => 0,
                'sort_order' => 10,
            ]));
        }

        if (!$this->totals->firstWhere('code', 'total')) {
            $this->totals->push(new OrderTotal([
                'code' => 'total',
                'title' => 'Итого',
                'value' => $this->totals->sum('value'),
                'sort_order' => 99,
            ]));
        }
    }

    public function getTotals(): \Illuminate\Support\Collection
    {
        return $this->totals;
    }

    public function apply(): void
    {
        $this->order->totals()->delete();
        $this->order->totals()->saveMany($this->totals);
    }
}
