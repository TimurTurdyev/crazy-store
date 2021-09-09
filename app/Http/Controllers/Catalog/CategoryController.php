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
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category, Request $request)
    {
        abort_if($category->status === 0, 404);

        $groups = $category->load('groups')->getRelation('groups');

        $params = array_merge(['group' => $groups->pluck('id')->join('.')], $request->all());

        $filter = collect([
            'groups' => $groups,
            'brands' => Brand::filter(
                new BrandFilters($params)
            )->get(),
            'sizes' => Size::filter(
                new SizeFilters($params)
            )->get(),
        ]);

        $products = Variant::filter(new ProductFilters($params))
            ->with(['prices', 'photos'])
            ->paginate(12)
            ->withQueryString();

        return view('catalog.category.index', compact('category', 'filter', 'products'));
    }
}
