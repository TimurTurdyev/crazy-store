<?php

namespace App\Http\Controllers\Catalog;

use App\Filters\BrandFilters;
use App\Filters\ProductFilters;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Variant;
use App\Repositories\FilterRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category, ProductFilters $productFilter)
    {
        abort_if($category->status === 0, 404);

        $groups = $category->load('groups')->getRelation('groups');

        $group_idx = $groups->pluck('id')->join('.');

        $productFilter->setRequestValue('group', $group_idx);

        $filter = (new FilterRepository($group_idx))->apply();

        $filter->put('groups', $groups);

        $products = Variant::filter($productFilter)
            ->with(['prices', 'photos'])
            ->paginate(12)
            ->withQueryString();;

        return view('catalog.category.index', compact('category', 'filter', 'products'));
    }
}
