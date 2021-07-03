<?php

namespace App\Http\Controllers\Catalog;

use App\Filters\ProductFilter;
use App\Filters\ProductFilters;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Variant;
use App\Repositories\FilterRepository;


class GroupController extends Controller
{
    public function index(Group $group, ProductFilters $productFilter)
    {
        abort_if($group->status === 0, 404);

        $categories = $group->load('categories')->getRelation('categories');

        $productFilter->requestMerge(['group' => $group->id]);

        $filterNav = (new FilterRepository($group->id));

        $filter = collect([
            'categories' => $categories,
            'brands' => $filterNav->brands(),
            'sizes' => $filterNav->sizes(),
        ]);

        $products = Variant::filter($productFilter)
            ->with(['prices', 'photos'])
            ->paginate(12)
            ->withQueryString();;

        return view('catalog.group.index', compact('group', 'filter', 'products'));
    }
}
