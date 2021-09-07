<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Brand;
use App\Models\Group;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::paginate(20);
        return view('admin.product.index', compact('products'));
    }

    public function create(): View
    {
        $product = new Product();
        $groups = Group::get();
        $brands = Brand::get();
        return view('admin.product.create_edit', compact('product', 'groups', 'brands'));
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $product = Product::create([
            'name' => $request->name,
            'group_id' => $request->group_id ?: null,
            'brand_id' => $request->brand_id ?: null,
            'status' => isset($request->status) ? 1 : 0,
        ]);

        $product->description()->updateOrCreate(['id' => $request->description['id'] ?? 0], $request->description);

        return redirect()->route('admin.product.edit', $product)->with('success', 'Вы успешно создали товар ' . $product->name);
    }

    public function show(Product $product): RedirectResponse
    {
        return redirect()->route('admin.catalog', $product);
    }

    public function edit(Product $product): View
    {
        $groups = Group::get();
        $brands = Brand::get();
        $sizes = Size::get();
        $product->load('variants.prices', 'variants.photos');
        return view('admin.product.create_edit', compact('product', 'groups', 'brands', 'sizes'));
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $product->update([
            'name' => $request->name,
            'group_id' => $request->group_id ?: null,
            'brand_id' => $request->brand_id ?: null,
            'status' => isset($request->status) ? 1 : 0,
        ]);

        $product->description()->updateOrCreate(['id' => $request->description['id'] ?? 0], $request->description);

        return redirect()->route('admin.product.edit', $product)->with('success', 'Вы успешно обновили товар ' . $product->name);
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Вы успешно удалили товар ' . $product->name);
    }
}
