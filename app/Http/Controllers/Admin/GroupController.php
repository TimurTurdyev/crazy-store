<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GroupRequest;
use App\Models\Group;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GroupController extends Controller
{
    public function index(): View
    {
        $groups = Group::withCount(['products'])->paginate(20);
        return view('admin.group.index', compact('groups'));
    }

    public function create(): View
    {
        $group = new Group();
        return view('admin.group.create_edit', compact('group'));
    }

    public function store(GroupRequest $request): RedirectResponse
    {
        $group = Group::create([
            'name' => $request->name,
            'status' => isset($request->status) ? 1 : 0,
        ]);

        $group->description()->updateOrCreate(['id' => $request->description['id'] ?? 0], $request->description);

        return redirect()->route('admin.group.index')->with('status', 'Вы успешно создали группу товаров ' . $group->name);
    }

    public function show(Group $group): RedirectResponse
    {
        return redirect()->route('admin.catalog', $group);
    }

    public function edit(Group $group): View
    {
        return view('admin.group.create_edit', compact('group'));
    }

    public function update(GroupRequest $request, Group $group): RedirectResponse
    {
        $group->update([
            'name' => $request->name,
            'status' => isset($request->status) ? 1 : 0,
        ]);

        $group->description()->updateOrCreate(['id' => $request->description['id'] ?? 0], $request->description);

        return redirect()->route('admin.group.index')->with('status', 'Вы успешно обновили группу товаров ' . $group->name);
    }

    public function destroy(Group $group): RedirectResponse
    {
        $group->delete();
        return redirect()->route('admin.group.index')->with('status', 'Вы успешно удалили группу товаров ' . $group->name);
    }
}
