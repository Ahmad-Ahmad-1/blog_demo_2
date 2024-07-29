<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Models\Role;

class UserController extends Controller implements HasMiddleware
{
    public function index()
    {
        $users = User::paginate(5);

        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        // User will just login.
    }

    public function store()
    {
        // User will just login.
    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        $allRoles = Role::pluck('name')->toArray();

        $userRoles = $user->getRoleNames()->toArray();

        return view('users.edit', ['user' => $user, 'allRoles' => $allRoles, 'userRoles' => $userRoles]);
    }

    public function update(User $user, UserUpdateRequest $request)
    {
        $user->update($request->safe()->except('roles'));

        $user->syncRoles($request->safe()->only('roles'));

        return to_route('users.edit', $user->id)->with('User Update Success', 'User has been updated successfully');
    }

    public function destroy()
    {
        // Maybe we'll return to a URL?
        return to_route('users.index');
    }

    public static function middleware()
    {
    }
}
