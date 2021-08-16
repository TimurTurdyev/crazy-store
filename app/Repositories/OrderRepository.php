<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderRepository implements OrderInterface
{

    private CartInterface $cart;

    public function __construct(CartInterface $cart)
    {
        $this->cart = $cart;
    }

    public function storeOrderDetails($params)
    {
        $sub_total = $this->cart->getProductDiscountTotal();

        $promo_discount = 0;
        $promo = $this->cart->promoCode();

        if ($promo && (int)$promo->discount) {
            $promo_discount = $promo->discount;
        }

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

            'total' => $sub_total + $promo_discount,

            'promo_code' => $promo?->code,

            'shipping_code' => $params['shipping_code'] ?? null,
            'payment_code' => $params['payment_code'] ?? null,

            'city' => $params['city'] ?? null,
            'address' => $params['address'] ?? null,
            'post_code' => $params['post_code'] ?? null,
            'notes' => $params['notes'] ?? null,
        ]);

        if ($order) {

            foreach ($this->cart->getItems() as $item) {
                // A better way will be to bring the product id with the cart items
                // you can explore the package documentation to send product id with the cart
                $product = Cart::where($item->id)->first();

                $orderItem = new OrderItem([
                    'product_id' => $product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->getPriceSum()
                ]);

                $order->items()->save($orderItem);
            }
        }

        return $order;
    }
}
