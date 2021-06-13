<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SizeRequest;
use App\Models\Size;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SizeController extends Controller
{
    public function index(): View
    {
        $sizes = Size::paginate(20);
        return view('admin.size.index', compact('sizes'));
    }

    public function create(): View
    {
        $size = new Size();
        return view('admin.size.create_edit', compact('size'));
    }

    public function store(SizeRequest $request): RedirectResponse
    {
        $size = Size::create([
            'name' => $request->name,
        ]);

        return redirect()->route('size.index')->with('success', 'Вы успешно создали размер ' . $size->name);
    }

    public function show(Size $size): RedirectResponse
    {
        return redirect()->route('catalog', $size);
    }

    public function edit(Size $size): View
    {
        return view('admin.size.create_edit', compact('size'));
    }

    public function update(SizeRequest $request, Size $size): RedirectResponse
    {
        $size->update([
            'name' => $request->name,
        ]);

        return redirect()->route('size.index')->with('success', 'Вы успешно обновили размер ' . $size->name);
    }

    public function destroy(Size $size): RedirectResponse
    {
        $size->delete();
        return redirect()->route('size.index')->with('success', 'Вы успешно удалили размер ' . $size->name);
    }
}
