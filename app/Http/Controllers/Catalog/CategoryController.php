<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        abort_if($category->status === 0, 404);

        $groups = $category->load('groups')->getRelation('groups');

        $group_idx = $groups->pluck('id')->all();

        $brands = Brand::select(['brands.id', 'brands.name'])
            ->join('products', 'brands.id', '=', 'products.brand_id')
            ->whereIn('products.group_id', $group_idx)
            ->groupBy(['brands.id', 'brands.name'])
            ->get();

        $sizes = Size::select(['sizes.id', 'sizes.name'])
            ->join('variant_prices', 'sizes.id', '=', 'variant_prices.size_id')
            ->join('variants', 'variant_prices.variant_id', '=', 'variants.id')
            ->join('products', 'variants.product_id', '=', 'products.id')
            ->whereIn('products.group_id', $group_idx)
            ->groupBy(['sizes.id', 'sizes.name'])
            ->get();

        $products = Product::with([
            'group',
            'variants.photos',
            'variants.prices'])
            ->whereIn('products.group_id', $group_idx)
            ->paginate();

        return view('catalog.category.index', compact('category', 'groups', 'brands', 'sizes', 'products'));
    }
}
