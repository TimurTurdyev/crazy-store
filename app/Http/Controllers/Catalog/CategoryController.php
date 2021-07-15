<?php

namespace App\Http\Controllers\Catalog;

use App\Filters\BrandFilters;
use App\Filters\ProductFilters;
use App\Filters\SizeFilters;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Size;
use App\Models\Variant;
use App\Repositories\FilterRepository;

class CategoryController extends Controller
{
    public function index(Category $category, ProductFilters $productFilter)
    {
        abort_if($category->status === 0, 404);

        $groups = $category->load('groups')->getRelation('groups');

        $productFilter->requestMerge([
            'group' => (request('group') ?? $groups->pluck('id')->join('.'))
        ]);

        $filter = collect([
            'groups' => $groups,
            'brands' => Brand::filter(
                new BrandFilters($productFilter->getRequest())
            )->get(),
            'sizes' => Size::filter(
                new SizeFilters($productFilter->getRequest())
            )->get(),
        ]);

        $products = Variant::filter($productFilter)
            ->with(['prices', 'photos'])
            ->paginate(12)
            ->withQueryString();;

        return view('catalog.category.index', compact('category', 'filter', 'products'));
    }
}
