<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Role\RoleStoreRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller implements HasMiddleware
{
    public function index()
    {
        return view('roles.index', ['roles' => Role::paginate(5)]);
    }

    public function show(Role $role)
    {
        return view('roles.show', [
            'role' => $role,
            'permissions' => $role->getAllPermissions()->pluck('name')->toArray()
        ]);
    }

    public function create()
    {
        return view('roles.create', [
            'permissions' => Permission::pluck('name')->toArray(),
        ]);
    }

    public function store(RoleStoreRequest $request)
    {
        $role = Role::create($request->safe()->only('name'));

        $role->syncPermissions($request->safe()->only('permissions'));

        return back()->with('status', 'Role has been created successfully');
    }

    public function edit(Role $role)
    {
        return view(
            'roles.edit',
            [
                'role' => $role,
                'allPermissions' => Permission::pluck('name')->toArray(),
                'rolePermissions' => $role->getAllPermissions()->pluck('name')->toArray(),
            ]
        );
    }

    public function update(Role $role, RoleUpdateRequest $request)
    {
        $role->update($request->safe()->only('name'));

        $role->syncPermissions($request->safe()->only('permissions'));

        return back()->with('status', 'Role has been updated successfully');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return to_route('roles.index')->with('status', 'Role has been deleted successfully');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $roles = Role::where('name', 'like', "%$search%")->paginate(5);

        return view('roles.search-results', ['roles' => $roles]);
    }

    public static function middleware()
    {
        return [
            new Middleware('permission:Create Role|Edit Role|Delete Role', only: ['index', 'show']),
            new Middleware('permission:Create Role', only: ['create', 'store']),
            new Middleware('permission:Edit Role', only: ['edit', 'update']),
            new Middleware('permission:Delte Role', only: ['destroy'])
        ];
    }
}
