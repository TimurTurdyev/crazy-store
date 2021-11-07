<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function index(): View
    {
        $brands = Brand::paginate(20);
        return view('admin.brand.index', compact('brands'));
    }

    public function create(): View
    {
        $brand = new Brand();
        return view('admin.brand.create_edit', compact('brand'));
    }

    public function store(BrandRequest $request): RedirectResponse
    {
        $brand = Brand::create([
            'name' => $request->name,
            'status' => isset($request->status) ? 1 : 0,
        ]);

        $brand->description()->updateOrCreate(['id' => $request->description['id'] ?? 0], $request->description);

        return redirect()->route('admin.brand.index')->with('status', 'Вы успешно создали бренд ' . $brand->name);
    }

    public function show(Brand $brand): RedirectResponse
    {
        return redirect()->route('admin.brand', $brand);
    }

    public function edit(Brand $brand): View
    {
        return view('admin.brand.create_edit', compact('brand'));
    }

    public function update(BrandRequest $request, Brand $brand): RedirectResponse
    {
        $brand->update([
            'name' => $request->name,
            'status' => isset($request->status) ? 1 : 0,
        ]);

        $brand->description()->updateOrCreate(['id' => $request->description['id'] ?? 0], $request->description);

        return redirect()->route('admin.brand.index')->with('status', 'Вы успешно обновили бренд ' . $brand->name);
    }

    public function destroy(Brand $brand): RedirectResponse
    {
        $brand->delete();
        return redirect()->route('admin.brand.index')->with('status', 'Вы успешно удалили бренд ' . $brand->name);
    }
}
