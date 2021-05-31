<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    public function create(): View
    {
        $variant = new Variant();
        return view('admin.variant.create_edit', compact('variant'));
    }

    public function store(Request $request): RedirectResponse
    {
        //
    }

    public function show($id): RedirectResponse
    {
        //
    }

    public function edit(Variant $variant): View
    {
        return view('admin.variant.create_edit', compact('variant'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    public function destroy($id): RedirectResponse
    {
        //
    }
}
