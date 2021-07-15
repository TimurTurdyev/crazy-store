<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Variant;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('site.pages.cart');
    }

    public function add(Request $request): \Illuminate\Http\RedirectResponse
    {
        $variant = Variant::where('id', $request->variant)->with('product', 'prices', 'photos')->firstOrFail();
        $price = $variant->prices->firstWhere('id', $request->price);
        $product_name = $variant->short_name ? $variant->product->name . ', ' . $variant->short_name : $variant->product->name;

        abort_if(
            $variant->product->status === 0 ||
            $variant->status === 0 ||
            !$price,
            '404');

        Cart::add($variant->id, $product_name, $price->price, $price->quantity);

        return redirect()->back()->with('message', 'Вы успешно добавили товар в корзину.');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        Cart::remove($id);

        if (Cart::isEmpty()) {
            return redirect('/');
        }
        return redirect()->back()->with('message', 'Item removed from cart successfully.');
    }

    public function clear(): \Illuminate\Http\RedirectResponse
    {
        Cart::clear();

        return redirect('/');
    }
}
