<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Models\Group;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::paginate(20);
        return view('admin.category.index', compact('categories'));
    }

    public function create(): View
    {
        $groups = Group::get();
        $group_selected['groupCategory'] = [];
        return view('admin.category.create_edit', compact('groups', 'group_selected'));
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $category = Category::create([
            'name' => $request->name,
            'status' => isset($request->status) ? 1 : 0,
        ]);

        $category->description()->updateOrCreate(['id' => $request->description['id'] ?? 0], $request->description);

        return redirect()->route('category.index')->with('success', 'Вы успешно создали категорию ' . $category->name);
    }

    public function show(Category $category): RedirectResponse
    {
        return redirect()->route('catalog', $category);
    }

    public function edit(Category $category): View
    {
        $groups = Group::get();
        $group_selected = $category->load(['groupCategory' => function($query) {
            $query->select('group_id');
        }])->getRelation('groupCategory')->map(function ($item) {
            return $item->group_id;
        })->toArray();

        return view('admin.category.create_edit', compact('category', 'groups', 'group_selected'));
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update([
            'name' => $request->name,
            'status' => isset($request->status) ? 1 : 0,
        ]);

        $category->description()->updateOrCreate(['id' => $request->description['id'] ?? 0], $request->description);

        if ($request->has('groups')) {
            $category->groupCategory()->sync($request->groups);
        } else {
            $category->groupCategory()->detach();
        }

        return redirect()->route('category.index')->with('success', 'Вы успешно обновили категорию ' . $category->name);
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Вы успешно удалили категорию ' . $category->name);
    }
}
