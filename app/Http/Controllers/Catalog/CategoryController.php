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

        $request_params = array_merge([
            'group' => $groups->pluck('id')->join('.'),
            'stock' => 'in',
            'status' => 'on',
        ], $request->all());


        $filter = collect([
            'groups' => $groups,
            'brands' => Brand::filter(
                new BrandFilters($request_params)
            )->get(),
            'sizes' => Size::filter(
                new SizeFilters($request_params)
            )->get(),
        ]);

        $products = Variant::filter(new ProductFilters($request_params))
            ->with(['prices', 'photos'])
            ->paginate(12)
            ->withQueryString();

        return view('catalog.category.index', compact('category', 'filter', 'products'));
    }
}
