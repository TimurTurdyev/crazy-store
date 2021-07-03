<?php

namespace App\Http\Controllers\Catalog;

use App\Filters\ProductFilters;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Variant;
use App\Repositories\FilterRepository;

class CategoryController extends Controller
{
    public function index(Category $category, ProductFilters $productFilter)
    {
        abort_if($category->status === 0, 404);

        $groups = $category->load('groups')->getRelation('groups');

        $group_idx = (request('group') ?? $groups->pluck('id')->join('.'));

        $productFilter->requestMerge(['group' => $group_idx]);

        $filterNav = (new FilterRepository($group_idx));

        $filter = collect([
            'groups' => $groups,
            'brands' => $filterNav->brands(),
            'sizes' => $filterNav->sizes(),
        ]);

        $products = Variant::filter($productFilter)
            ->with(['prices', 'photos'])
            ->paginate(12)
            ->withQueryString();;

        return view('catalog.category.index', compact('category', 'filter', 'products'));
    }
}
