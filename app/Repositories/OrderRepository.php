<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PromoCode;
use App\Models\VariantPrice;
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
        $sub_total = $this->cart->getProductDiscountTotal();

        $promo_discount = 0;
        $promo = $this->cart->promoCode();

        if ($promo && (int)$promo->discount) {
            $promo_discount = $promo->discount;
        }

        $delivery = $this->getDelivery($params);

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_code' => Str::uuid(),

            'ip' => request()->ip(),
            'firstname' => $params['firstname'],
            'lastname' => $params['lastname'],
            'email' => $params['email'],
            'phone' => $params['phone'],

            'item_count' => $this->cart->getCount(),

            'sub_total' => $sub_total,
            'promo_value' => $promo_discount,

            'delivery_value' => $delivery->price,

            'total' => $sub_total + $promo_discount + $delivery->price,

            'promo_code' => $promo?->code,

            'delivery_code' => $delivery->code,
            'delivery_name' => $delivery->name,

            'payment_code' => $params['payment_code'] ?? null,
            'payment_name' => $params['payment_name'] ?? null,

            'city' => $params['city'] ?? null,
            'address' => $params['address'] ?? null,
            'post_code' => $params['post_code'] ?? null,
            'notes' => $params['notes'] ?? null,
        ]);

        if ($order) {
            foreach ($this->cart->getItems() as $cart_item) {

                VariantPrice::where('id', $cart_item->price_id)->decrement('quantity', $cart_item->quantity);

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
            'code' => null,
            'name' => null,
            'price' => 0,
        ];

        $value = session('deliveries', collect())->firstWhere('code', $params['delivery_code'] ?? 'not');

        if ($value) {
            $delivery->code = (string)$value['code'];
            $delivery->name = (string)$value['name'];
            $delivery->price = (int)$value['price'];

            if (Str::contains($params['delivery_code'], 'cdek.pvz') && !empty($params['pvz_address'])) {
                $delivery->name = sprintf('ПВЗ[%s]: %s', (string)$params['pvz_code'], (string)$params['pvz_address']);
            }
        }

        return $delivery;
    }
}
