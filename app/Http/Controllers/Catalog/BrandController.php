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
    protected function index(Brand $brand, ProductFilters $productFilter)
    {
        abort_if($brand->status === 0, 404);

        $productFilter->requestMerge(['brand' => $brand->id]);

        $filter = collect([
            'groups' => $brand->load('groups')->getRelation('groups'),
            'sizes' => Size::filter(
                new SizeFilters($productFilter->getRequest())
            )->get(),
        ]);

        $products = Variant::filter($productFilter)
            ->with(['prices', 'photos'])
            ->paginate(12)
            ->withQueryString();;

        return view('catalog.brand.index', compact('brand', 'filter', 'products'));
    }
}
