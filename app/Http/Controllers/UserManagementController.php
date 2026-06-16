<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\UserService;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->paginate(10);
        return view('user-manage.index', compact('users'));
    }

    public function create()
    {
        return view('user-manage.create');
    }

    public function store(
        StoreUserRequest $request,
        UserService $userService,
    ) {
        $validated = $request->validated();
        $user = $userService->create($validated);
        return redirect()
            ->route("user-manage.index")
            ->with('success', 'User berhasil dibuat!!');
    }

    public function edit() {}

    public function update() {}

    public function delete(User $user, UserService $userService)
    {
        $userService->delete($user);
        return redirect()
            ->route('user-manage.index')
            ->with('success', 'User berhasil dihapus!!');
    }
}
