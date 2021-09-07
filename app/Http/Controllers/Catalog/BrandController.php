<?php

namespace App\Http\Controllers\Catalog;

use App\Filters\ProductFilters;
use App\Filters\SizeFilters;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Size;
use App\Models\Variant;
use App\Repositories\FilterRepository;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected function index(Brand $brand, Request $request)
    {
        abort_if($brand->status === 0, 404);

        $params = array_merge($request->all(), ['brand' => $brand->id]);

        $filter = collect([
            'groups' => $brand->load('groups')->getRelation('groups'),
            'sizes' => Size::filter(
                new SizeFilters($params)
            )->get(),
        ]);

        $products = Variant::filter(new ProductFilters($params))
            ->with(['prices', 'photos'])
            ->paginate(12)
            ->withQueryString();

        return view('catalog.brand.index', compact('brand', 'filter', 'products'));
    }
}
