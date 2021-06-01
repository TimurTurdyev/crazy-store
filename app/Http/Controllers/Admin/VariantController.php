<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Size;
use App\Models\Variant;
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
        
        return view('admin.variant.create_edit', compact('product','variant', 'sizes'));
    }

    public function store(Product $product, Request $request): RedirectResponse
    {

    }

    public function show($id): RedirectResponse
    {
        //
    }

    public function edit(Variant $variant): View
    {
        return view('admin.variant.create_edit', compact('variant'));
    }

    public function update(Product $product, Variant $variant): RedirectResponse
    {
        //
    }

    public function destroy($id): RedirectResponse
    {
        //
    }
}
