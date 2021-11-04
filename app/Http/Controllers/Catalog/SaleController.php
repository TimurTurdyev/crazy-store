<?php

namespace App\Http\Controllers\Catalog;

use App\Filters\BrandFilter;
use App\Filters\ProductFilter;
use App\Filters\SizeFilter;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Size;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $groups = Cache::remember('groups2sale', 60 * 60, function () {
            $query = Variant::filter(new ProductFilter([
                'discount' => 'yes'
            ]))->select('group_id')->getQuery();

            $query->groups = [];
            $query->groupBy('group_id');

            return $query->get();
        });

        $request_params = array_merge([
            'group' => $groups->pluck('group_id')->join('.'),
            'stock' => 'in',
            'status' => 'on',
            'discount' => 'yes'
        ], $request->all());


        $filter = collect([
            'brands' => Cache::remember('brands2sale', 60 * 60, function () use ($request_params) {
                return Brand::filter(
                    new BrandFilter($request_params)
                )->get();
            }),
            'sizes' => Cache::remember('sizes2sale', 60 * 60, function () use ($request_params) {
                return Size::filter(
                    new SizeFilter($request_params)
                )->get();
            }),
        ]);

        $products = Variant::filter(new ProductFilter($request_params))
            ->where('variant_prices.discount', '>', 0)
            ->with(['prices', 'photos'])
            ->paginate(12)
            ->withQueryString();

        return view('catalog.sale.index', compact('filter', 'products'));
    }
}
