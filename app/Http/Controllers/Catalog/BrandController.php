<?php

namespace App\Http\Controllers\Catalog;

use App\Filters\ProductFilters;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Variant;
use App\Repositories\FilterRepository;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected function index(Brand $brand, ProductFilters $productFilter)
    {
        abort_if($brand->status === 0, 404);

        $groups = $brand->load('groups')->getRelation('groups');

        $group_idx = request('group') ?? $groups->pluck('id')->join('.');

        $productFilter->requestMerge(['brand' => $brand->id]);

        $filterNav = (new FilterRepository($group_idx));

        $filter = collect([
            'groups' => $groups,
            'sizes' => $filterNav->sizes(),
        ]);

        $products = Variant::filter($productFilter)
            ->with(['prices', 'photos'])
            ->paginate(12)
            ->withQueryString();;

        return view('catalog.brand.index', compact('brand', 'filter', 'products'));
    }
}
