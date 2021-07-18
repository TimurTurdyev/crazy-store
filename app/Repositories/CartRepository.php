<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\VariantPrice;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CartRepository implements CartInterface
{
    private string $cart_session;
    private int|null $user_id;

    public function __construct()
    {
        Cart::where('user_id', 'IS NULL')->where('updated_at', '<', 'DATE_SUB(NOW(), INTERVAL 72 HOUR)')->delete();

        if (session('cart') === null) {
            session()->put('cart', uniqid());
        }

        $this->cart_session = session('cart');
        $this->user_id = Auth::id();

        if ($this->user_id) {
            Cart::where('session_id', $this->cart_session)
                ->orWhere('user_id', $this->user_id)
                ->update(['user_id' => $this->user_id, 'session_id' => $this->cart_session]);
        }
    }

    public function getCount(): int
    {
        return $this->getItems()->count();
    }

    public function findVariant(int $price_id, int $quantity): VariantPrice
    {
        $price = VariantPrice::where('id', $price_id)
            ->with('variant')
            ->first();

        if (!$price) {
            session()->put('error.' . $price_id, 'На складе отсутствует или не найдена данная позиция товара.');
            return new VariantPrice();
        };

        if ($price && $price->quantity < $quantity) {
            session()->put('error.' . $price_id, sprintf('Кол-во на складе: %s шт.', $price->quantity));
            return new VariantPrice();;
        }

        return $price;
    }

    public function add(int $price_id, int $quantity)
    {
        $price = $this->findVariant($price_id, $quantity);

        if (!$price->variant_id) {
            return 0;
        }

        $cart_id = Cart::updateOrCreate([
            'session_id' => $this->cart_session,
            'user_id' => $this->user_id,
            'variant_id' => $price->variant_id,
            'price_id' => $price->id,
        ], [
            'session_id' => $this->cart_session,
            'user_id' => $this->user_id,
            'variant_id' => $price->variant_id,
            'price_id' => $price->id,
            'quantity' => $quantity,
        ]);

        return $cart_id;
    }

    public function update(int $id, int $price_id, int $quantity)
    {
        $cart_id = $this->add($price_id, $quantity);

        if ($id !== $cart_id) {
            Cart::destroy($id);
        }

        return $cart_id;
    }

    public function getItems(): Collection
    {
        $items = collect();

        foreach (Cart::where('session_id', $this->cart_session)->with(['variant.prices', 'variant.photos'])->get() as $item) {
            $variant = $item->variant;
            $price = $variant->prices->firstWhere('id', $item->price_id);

            if ($price === null || $price->quantity < 1) {
                Cart::destroy($item->id);
                continue;
            }

            if ($item->quantity > $price->quantity) {
                Cart::where('id', $item->id)->update(['quantity' => $price->quantity]);
                $item->quantity = $price->quantity;
            }

            $photo_path = $variant->photos->first()?->path;

            $items->push([
                'cart_id' => $item->id,
                'product_id' => $variant->product_id,
                'variant_id' => $item->variant_id,
                'price_id' => $item->price_id,
                'name' => $variant->full_name,
                'photo' => asset($photo_path),
                'quantity' => $item->quantity,
                'price' => $price,
                'prices' => $variant->prices,
            ]);
        }

        return $items;
    }

    public function remove($id)
    {
        Cart::destroy($id);
    }
}
