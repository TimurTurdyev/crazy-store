<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\OrderItem;
use App\Models\OrderTotal;
use App\Models\PromoCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderRepository implements OrderInterface
{
    private CartInterface $cart;

    public function __construct(CartInterface $cart)
    {
        $this->cart = $cart;
    }

    public function storeOrderDetails($params): null|Order
    {
        $promo = $this->cart->promoCode();

        $totals = collect();

        $totals->push(new OrderTotal([
            'code' => 'subtotal',
            'title' => 'Всего',
            'value' => $this->cart->getProductDiscountTotal(),
            'sort_order' => 0,
        ]));

        $totals->push(new OrderTotal([
            'code' => 'promo',
            'title' => 'Скидка(' . ($promo?->code ?? '-') . ')',
            'value' => $promo?->discount ?? 0,
            'sort_order' => 1,
        ]));

        $delivery = $this->getDelivery($params);

        $totals->push(new OrderTotal([
            'code' => 'delivery',
            'title' => $delivery->method,
            'value' => $delivery->price,
            'sort_order' => 10,
        ]));

        $totals->push(new OrderTotal([
            'code' => 'total',
            'title' => 'Итого',
            'value' => $totals->sum('value'),
            'sort_order' => 99,
        ]));

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_code' => Str::uuid(),

            'ip' => request()->ip(),
            'firstname' => $params['firstname'],
            'lastname' => $params['lastname'],
            'email' => $params['email'],
            'phone' => $params['phone'],

            'payment_code' => $params['payment_code'] ?? null,
            'payment_instruction' => '',

            'city' => $params['city'] ?? null,
            'address' => $params['address'] ?? null,
            'post_code' => $params['post_code'] ?? null,
        ]);

        if ($order) {
            $order->totals()->saveMany($totals);

            if (!empty($params['notes'])) {
                $history = new OrderHistory([
                    'order_id' => $order->id,
                    'status' => 0,
                    'notify' => 1,
                    'message' => $params['notes']
                ]);

                $history->save();
            }

            foreach ($this->cart->getItems() as $cart_item) {
                $orderItem = new OrderItem([
                    'product_id' => $cart_item->product_id,
                    'variant_id' => $cart_item->variant_id,
                    'price_id' => $cart_item->price_id,
                    'name' => $cart_item->price->name ? sprintf('%s, %s', $cart_item->name, $cart_item->price->name) : $cart_item->name,
                    'photo' => $cart_item->photo,
                    'quantity' => $cart_item->quantity,
                    'price_old' => $cart_item->price->discount_price,
                    'price' => $cart_item->price->price,
                ]);

                $order->items()->save($orderItem);
            }

            $this->cart->destroyCart();
            $this->cart->promoCodeRemove();

            if ($order->promo_code) {
                PromoCode::where('code', $order->promo_code)->increment('total');
            }
        }

        return $order;
    }

    private function getDelivery($params): object
    {
        $delivery = (object)[
            'method' => null,
            'price' => 0,
            'code' => '',
        ];

        $value = session('deliveries', collect())->firstWhere('code', $params['delivery_code'] ?? 'not');

        if ($value) {
            $delivery->method = (string)$value['name'];
            $delivery->price = (int)$value['price'];
            $delivery->code = (int)$value['code'];

            if (Str::contains($params['delivery_code'], 'cdek.pvz') && !empty($params['pvz_address'])) {
                $delivery->method = sprintf('ПВЗ[%s]: %s', (string)$params['pvz_code'], (string)$params['pvz_address']);
            }
        }

        return $delivery;
    }
}
