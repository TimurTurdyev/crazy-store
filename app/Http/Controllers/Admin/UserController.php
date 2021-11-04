<?php

namespace App\Http\Controllers\Admin;

use App\Filters\UserFilter;
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

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'Вы успешно удалили пользователя ' . $user->firstname);
    }

    public function startSession(User $user): RedirectResponse
    {
        session()->put('customer_id', $user->id);

        return redirect()->route('customer.orders');
    }

    public function filter(Request $request): \Illuminate\Http\JsonResponse
    {
        $users = User::filter(new UserFilter($request->only(['all_fields'])))
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
