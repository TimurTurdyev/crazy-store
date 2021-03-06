<?php

namespace App\Http\Controllers\Catalog;

use App\Filters\BrandFilter;
use App\Filters\ProductFilter;
use App\Filters\SizeFilter;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Size;
use App\Models\Variant;
use App\Repositories\FilterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index(Category $category, Request $request)
    {
        abort_if($category->status === 0, 404);

        $groups = Cache::remember('groups2category' . $category->id, 60 * 60, function () use ($category) {
            return $category->load('groups')->getRelation('groups');
        });

        $request_params = array_merge([
            'group' => $groups->pluck('id')->join('.'),
            'stock' => 'in',
            'status' => 'on',
        ], $request->all());


        $filter = collect([
            'groups' => $groups,
            'brands' => Cache::remember('brands2category' . $category->id, 60 * 60, function () use ($request_params) {
                return Brand::filter(
                    new BrandFilter($request_params)
                )->get();
            }),
            'sizes' => Cache::remember('sizes2category' . $category->id, 60 * 60, function () use ($request_params) {
                return Size::filter(
                    new SizeFilter($request_params)
                )->get();
            }),
        ]);

        $products = Variant::filter(new ProductFilter($request_params))
            ->with(['prices', 'photos'])
            ->paginate(12)
            ->withQueryString();

        return view('catalog.category.index', compact('category', 'filter', 'products'));
    }
}
