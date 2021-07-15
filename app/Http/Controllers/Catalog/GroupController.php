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


class GroupController extends Controller
{
    public function index(Group $group, ProductFilters $productFilter)
    {
        abort_if($group->status === 0, 404);

        $categories = $group->load('categories')->getRelation('categories');

        $productFilter->requestMerge(['group' => $group->id]);

        $filter = collect([
            'categories' => $categories,
            'brands' => Brand::filter(
                new BrandFilters($productFilter->getRequest())
            )->get(),
            'sizes' => Size::filter(
                new SizeFilters($productFilter->getRequest())
            )->get(),
        ]);

        $products = Variant::filter($productFilter)
            ->with(['prices', 'photos'])
            ->paginate(12)
            ->withQueryString();;

        return view('catalog.group.index', compact('group', 'filter', 'products'));
    }
}
