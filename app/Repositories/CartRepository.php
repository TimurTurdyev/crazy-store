<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\VariantPrice;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CartRepository implements CartInterface
{
    private string $cart_session;
    private int|null $user_id;
    private static Collection $items;
    private array $message = [];

    public function __construct()
    {
        self::$items = collect();
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

    public function getProductPriceTotal(): int
    {
        return $this->getItems()->sum(function ($cart) {
            return $cart->price->price * $cart->quantity;
        });
    }

    public function getProductDiscountTotal(): int
    {
        return $this->getItems()->sum(function ($cart) {
            return $cart->price->discount_price * $cart->quantity;
        });
    }

    public function getProductSumIfNotDiscount()
    {
        return $this->getItems()->sum(function ($cart) {
            if ($cart->price->discount_price < $cart->price->price) return 0;
            return $cart->price->price * $cart->quantity;
        });
    }

    public function getCount(): int
    {
        return $this->getItems()->count();
    }

    public function add(int $price_id, int $quantity): Cart
    {
        $this->clearCache();

        $price = VariantPrice::find($price_id);

        if (!$price) {
            return new Cart();
        };

        return Cart::updateOrCreate([
            'session_id' => $this->cart_session,
            'user_id' => $this->user_id,
            'variant_id' => $price->variant_id,
            'price_id' => $price->id,
        ], [
            'quantity' => $quantity,
        ]);
    }

    public function update(int $id, int $price_id, int $quantity): Cart
    {
        $this->clearCache();

        $price = VariantPrice::find($price_id);
        $cart = Cart::where('id', $id)->where('session_id', $this->cart_session)->first();

        if (!$price || !$cart) {
            return new Cart();
        };

        $cart->update([
            'variant_id' => $price->variant_id,
            'price_id' => $price->id,
            'quantity' => $quantity,
        ]);

        Cart::where('id', '<>', $cart->id)
            ->where('session_id', $this->cart_session)
            ->where('variant_id', $price->variant_id)
            ->where('price_id', $price->id)
            ->delete();

        return $cart;
    }

    public function clearCache()
    {
        Cache::pull('cart.' . $this->cart_session);
    }

    public function getItems(): Collection
    {
        if (self::$items->count() === 0) {
            self::$items = Cache::remember('cart.' . $this->cart_session, 60 * 60, function () {
                $items = collect();
                foreach (Cart::where('session_id', $this->cart_session)->with(['variant.product', 'variant.prices', 'variant.photos'])->get() as $item) {
                    $variant = $item->variant;
                    $photo_path = $variant->photos->first()?->path;
                    $price = $variant->prices->firstWhere('id', $item->price_id);

                    if ($price === null || $price->quantity < 1) {
                        Cart::destroy($item->id);
                        continue;
                    }

                    $message = '';
                    if ($item->quantity > $price->quantity) {
                        $message = $this->messageCount($price->quantity);
                    }

                    $items->push((object)[
                        'cart_id' => $item->id,
                        'product_id' => $variant->product_id,
                        'variant_id' => $item->variant_id,
                        'price_id' => $item->price_id,
                        'name' => $variant->full_name,
                        'photo' => asset($photo_path),
                        'quantity' => $item->quantity,
                        'price' => $price,
                        'prices' => $variant->prices,
                        'message' => $message
                    ]);
                }
                return $items;
            });
        }

        return self::$items;
    }

    public function validateQuantity(): Collection
    {
        $this->clearCache();
        return $this->getItems()->filter(function ($cart) {
            return $cart->message !== '';
        });
    }

    public function setCoupon($code): void
    {
        $coupon = Coupon::where('code', $code)->firstOrNew();
        $message = $coupon->validateMessage($code);

        if ($message) {
            $this->message['coupon_error'] = $message;
            return;
        }

        $this->message['coupon_success'] = sprintf('Вы успешно добавили код купона %s!', $coupon->code);

        session()->put('coupon', (object)[
            'id' => $coupon->id,
            'code' => $coupon->code,
            'discount' => $coupon->discountPrice($this->getProductSumIfNotDiscount())
        ]);
    }

    public function __get($name)
    {
        return $this->message[$name] ?? '';
    }

    public function couponRemove()
    {
        $coupon = $this->getCoupon();
        if ($coupon) {
            $this->message['coupon_success'] = sprintf('Вы успешно удалили код купона %s!', $coupon->code);
        }
        session()->pull('coupon');
    }

    public function getCoupon()
    {
        return session('coupon');
    }

    public function remove($id): void
    {
        $this->clearCache();
        Cart::destroy($id);
    }

    private function messageCount($count): string
    {
        return sprintf('Кол-во на складе: %s шт.!', $count);
    }
}
