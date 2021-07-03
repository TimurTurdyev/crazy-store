<?php

namespace App\Http\Controllers\Catalog;

use App\Filters\ProductFilter;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Variant;
use App\Repositories\FilterRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category, Request $request)
    {
        abort_if($category->status === 0, 404);

        $groups = $category->load('groups')->getRelation('groups');

        $group_idx = $groups->pluck('id')->join('.');

        $filter = (new FilterRepository($group_idx))->apply();

        $filter->put('groups', $groups);

        $products = (new ProductFilter(
            Variant::filter(),
            array_merge(['group' => $group_idx], $request->all())
        ))->apply()->paginate(12)->withQueryString();

        return view('catalog.category.index', compact('category', 'filter', 'products'));
    }
}
