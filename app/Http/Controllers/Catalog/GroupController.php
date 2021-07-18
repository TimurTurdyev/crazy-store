<?php

namespace App\Http\Controllers\Catalog;

use App\Filters\BrandFilters;
use App\Filters\ProductFilter;
use App\Filters\ProductFilters;
use App\Filters\SizeFilters;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Group;
use App\Models\Size;
use App\Models\Variant;
use App\Repositories\FilterRepository;
use Illuminate\Http\Request;


class GroupController extends Controller
{
    public function index(Group $group, Request $request)
    {
        abort_if($group->status === 0, 404);

        $categories = $group->load('categories')->getRelation('categories');

        $params = array_merge($request->all(), ['group' => $group->id]);

        $filter = collect([
            'categories' => $categories,
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
            ->withQueryString();;

        return view('catalog.group.index', compact('group', 'filter', 'products'));
    }
}
