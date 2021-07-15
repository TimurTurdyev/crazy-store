<?php

namespace App\Repositories;

use App\Models\Variant;
use Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Contracts\OrderContract;

class OrderRepository extends BaseRepository implements OrderContract
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function storeOrderDetails($params)
    {
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'user_id' => auth()->user()->id,
            'status' => 'pending',
            'total' => Cart::getSubTotal(),
            'item_count' => Cart::getTotalQuantity(),
            'payment_status' => 0,
            'payment_method' => null,
            'shipping_status' => null,
            'shipping_method' => null,
            'firstname' => $params['firstname'],
            'lastname' => $params['lastname'],
            'address' => $params['address'],
            'city' => $params['city'],
            'country' => $params['country'],
            'post_code' => $params['post_code'],
            'phone' => $params['phone'],
            'notes' => $params['notes']
        ]);

        if ($order) {

            $items = Cart::getContent();

            foreach ($items as $item) {
                // A better way will be to bring the product id with the cart items
                // you can explore the package documentation to send product id with the cart
                $product = Variant::where($item->id)->firstOrFail();

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
