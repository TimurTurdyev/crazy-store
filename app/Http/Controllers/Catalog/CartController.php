<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Repositories\CartInterface;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function index(CartInterface $cartService)
    {
        $cartCollection = $cartService->getItems();

        if (request()->ajax()) {
            return view('catalog.cart.content', compact('cartCollection'));
        }

        return view('catalog.cart.index', compact('cartCollection'));
    }

    public function add(CartInterface $cartService, Request $request): \Illuminate\Http\RedirectResponse
    {
        $message = $cartService->add($request->price, $request->quantity);

        return redirect()->back()->with('message', 'Вы успешно добавили товар в корзину.');
    }

    public function update(CartInterface $cartService, Request $request)
    {
        abort_if(
            !$request->cart ||
            !$request->price || !is_array($request->price) ||
            !isset($request->price[$request->cart]) ||
            !$request->quantity, 404);

        $message = $cartService->update($request->cart, $request->price[$request->cart], $request->quantity);

        return $this->index($cartService);
    }

    public function destroy(CartInterface $cartService, $id): \Illuminate\Http\RedirectResponse
    {
        $cartService->remove($id);

        return redirect()->back()->with('message', 'Вы успешно удалили товар из корзины.');
    }

    public function clear(): \Illuminate\Http\RedirectResponse
    {
        Cart::clear();

        return redirect('/');
    }
}
