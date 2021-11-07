<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index(Product $product, Request $request): \Illuminate\Contracts\View\View
    {
        session()->put('cart_id', uniqid());


        $variants = Variant::where('product_id', $product->id)
            ->where('status', 1)
            ->with('prices', 'photos')->get();

        if ($request->variant === null) {
            $variant = $variants->first();
        } else {
            $variant = $variants->firstWhere('id', $request->variant);
        }

        abort_if(
            $product->status === 0 || (!$variant || $variant->status === 0),
            '404');

        $selected_price = $variant->prices->firstWhere('quantity', '>', 0);

        if ($selected_price === null) {
            $selected_price = $variant->prices->first();
        }

        return view('catalog.product.index', compact('product', 'variants', 'variant', 'selected_price'));
    }
}
