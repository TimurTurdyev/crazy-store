<?php

namespace App\Http\Controllers\Catalog;

use App\Filters\BrandFilter;
use App\Filters\ProductFilter;
use App\Filters\SizeFilter;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Group;
use App\Models\Size;
use App\Models\Variant;
use Illuminate\Http\Request;


class GroupController extends Controller
{
    public function index(Group $group, Request $request): \Illuminate\Contracts\View\View
    {
        abort_if($group->status === 0, 404);

        $categories = $group->load('categories')->getRelation('categories');

        $request_params = array_merge(
            [
                'stock' => 'in',
                'status' => 'on'
            ],
            array_merge($request->all(), ['group' => $group->id])
        );

        $filter = collect([
            'categories' => $categories,
            'brands' => Brand::filter(
                new BrandFilter($request_params)
            )->get(),
            'sizes' => Size::filter(
                new SizeFilter($request_params)
            )->get(),
        ]);

        $products = Variant::filter(new ProductFilter($request_params))
            ->with(['prices', 'photos'])
            ->paginate(12)
            ->withQueryString();;

        return view('catalog.group.index', compact('group', 'filter', 'products'));
    }
}
