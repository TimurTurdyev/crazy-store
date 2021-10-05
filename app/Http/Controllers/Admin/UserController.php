<?php

namespace App\Http\Controllers\Admin;

use App\Filters\UserFilterAbstract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::paginate(50)->withQueryString();
        return view('admin.user.index', compact('users'));
    }

    public function edit(User $user): View
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());

        return redirect()->route('admin.user.index')->with('success', 'Вы успешно обновили размер ' . $user->firstname);
    }

    public function filter(Request $request): \Illuminate\Http\JsonResponse
    {
        $users = User::filter(new UserFilterAbstract($request->only(['all_fields'])))
            ->limit(12)
            ->get();

        $user_data = [];

        foreach ($users as $user) {
            $user_data[] = [
                'name' => $user->full_name,
                'value' => $user->id,
                'data' => $user
            ];
        }

        return response()->json($user_data);
    }
}
