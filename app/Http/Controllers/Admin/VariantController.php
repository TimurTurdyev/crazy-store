<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VariantRequest;
use App\Models\Price;
use App\Models\Product;
use App\Models\Size;
use App\Models\Variant;
use App\Models\VariantPrice;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VariantController extends Controller
{
    public function index(): View
    {
        //
    }

    public function create(Product $product): View
    {
        $variant = new Variant();
        $sizes = Size::get();

        return view('admin.variant.create_edit', compact('product', 'variant', 'sizes'));
    }

    public function store(Product $product, VariantRequest $request): RedirectResponse
    {

        $variant = Variant::create([
            'product_id' => $product->id,
            'short_name' => $request->short_name,
            'sku' => $request->sku,
            'status' => isset($request->status) ? 1 : 0,
        ]);

        foreach ($request->prices as $price) {
            $price['variant_id'] = $variant->id;
            $variant->prices()->create($price);
        }

        return redirect()->route('product.edit', $product);
    }

    public function show($id): RedirectResponse
    {
        //
    }

    public function edit(Product $product, Variant $variant): View
    {
        $sizes = Size::get();

        return view('admin.variant.create_edit', compact('product', 'variant', 'sizes'));
    }

    public function update(Product $product, VariantRequest $request): RedirectResponse
    {

        $variant = Variant::findOrFail($request->id);

        $variant->update([
            'short_name' => $request->short_name,
            'sku' => $request->sku,
            'status' => isset($request->status) ? 1 : 0,
        ]);

        $price_exist = [];

        foreach ($request->prices as $price) {
            $price['variant_id'] = $variant->id;
            $price = VariantPrice::updateOrCreate($price);
            $price_exist[] = $price->id;
        }

        VariantPrice::where('variant_id', $variant->id)->whereNotIn('id', $price_exist)->delete();

        return redirect()->route('product.edit', $product);
    }

    public function destroy(Product $product, Variant $variant): RedirectResponse
    {
        $variant->delete();

        return redirect()->route('product.edit', $product);
    }
}
