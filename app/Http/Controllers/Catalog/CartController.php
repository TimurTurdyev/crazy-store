<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Repositories\CartInterface;
use Illuminate\Http\Request;


class CartController extends Controller
{

    public function index(CartInterface $cart)
    {
        if (request()->ajax()) {
            return response()->view('catalog.cart.content', compact('cart'))
                ->header('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate');
        }
        return response()->view('catalog.cart.index', compact('cart'))
            ->header('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate');
    }

    public function add(CartInterface $cart, Request $request): \Illuminate\Http\RedirectResponse
    {
        $cart->add($request->price, $request->quantity);

        return redirect()->back()->with('message', 'Вы успешно добавили товар в корзину.');
    }

    public function update(CartInterface $cart, Request $request)
    {
        $cart->update($request->cart, $request->price[$request->cart], $request->quantity);

        return $this->index($cart);
    }

    public function promoAdd(CartInterface $cart, Request $request)
    {
        $cart->setPromoCode($request->promo_code);
        return $this->index($cart);
    }

    public function promoRemove(CartInterface $cart)
    {
        $cart->promoRemove();
        return $this->index($cart);
    }

    public function destroy(CartInterface $cart, $id): \Illuminate\Http\RedirectResponse
    {
        $cart->remove($id);

        return redirect()->back()->with('message', 'Вы успешно удалили товар из корзины.');
    }

    public function clear(): \Illuminate\Http\RedirectResponse
    {
        Cart::clear();

        return redirect('/');
    }
}
