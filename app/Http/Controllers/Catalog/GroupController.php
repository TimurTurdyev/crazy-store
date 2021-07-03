<?php

namespace App\Http\Controllers\Catalog;

use App\Filters\ProductFilter;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Variant;
use App\Repositories\FilterRepository;
use Illuminate\Http\Request;


class GroupController extends Controller
{
    public function index(Group $group, Request $request)
    {
        abort_if($group->status === 0, 404);

        $categories = $group->load('categories')->getRelation('categories');

        $filter = (new FilterRepository($group->id))->apply();
        $filter->put('categories', $categories);

        $products = (new ProductFilter(
            Variant::filter(),
            array_merge(['group' => $group->id], $request->all())
        ))->apply()->paginate();

        return view('catalog.group.index', compact('group', 'filter', 'products'));
    }
}
