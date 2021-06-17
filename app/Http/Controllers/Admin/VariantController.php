<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VariantRequest;
use App\Models\Product;
use App\Models\Size;
use App\Models\Variant;
use App\Models\VariantPhoto;
use App\Models\VariantPrice;
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

        if (!empty($request->prices)) {
            foreach ($request->prices as $price) {
                $price['variant_id'] = $variant->id;
                $variant->prices()->create($price);
            }
        }

        if (!empty($request->photos)) {
            foreach ($request->photos as $photos) {
                $photos['variant_id'] = $variant->id;
                $variant->photos()->create($photos);
            }
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

        if (!empty($request->prices)) {
            $price_exist = [];

            foreach ($request->prices as $price) {
                $price['variant_id'] = $variant->id;
                $price = VariantPrice::updateOrCreate($price);
                $price_exist[] = $price->id;
            }

            VariantPrice::where('variant_id', $variant->id)->whereNotIn('id', $price_exist)->delete();
        }

        if (!empty($request->photos)) {
            $photos_exist = [];

            foreach ($request->photos as $photos) {
                $photos['variant_id'] = $variant->id;
                if (!isset($variant['path'])) {
                    $variant['path'] = 'images/placeholder.png';
                }
                $photos = VariantPhoto::updateOrCreate($photos);
                $photos_exist[] = $photos->id;
            }

            VariantPhoto::where('variant_id', $variant->id)->whereNotIn('id', $photos_exist)->delete();
        }

        return redirect()->route('product.edit', $product);
    }

    public function destroy(Product $product, Variant $variant): RedirectResponse
    {
        $variant->delete();

        return redirect()->route('product.edit', $product);
    }
}
