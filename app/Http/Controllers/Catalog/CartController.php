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
        $message = $cart->add($request->price, $request->quantity);

        return redirect()->back()->with('message', 'Вы успешно добавили товар в корзину.');
    }

    public function update(CartInterface $cart, Request $request)
    {
//        abort_if(
//            !$request->cart ||
//            !$request->price || !is_array($request->price) ||
//            !isset($request->price[$request->cart]) ||
//            !$request->quantity, 404);

        $cart->update($request->cart, $request->price[$request->cart], $request->quantity);

        return $this->index($cart);
    }

    public function couponAdd(CartInterface $cart, Request $request)
    {
        $cart->setCoupon($request->coupon_code);
        return $this->index($cart);
    }

    public function couponRemove(CartInterface $cart)
    {
        $cart->couponRemove();
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
