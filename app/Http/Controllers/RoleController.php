<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        return view('roles.index', compact('roles', 'permissions'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:roles,name',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::create($request->only('name'));

        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Роль створена успішно!');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:roles,name,' . $role->id,
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->update($request->only('name'));

        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Роль оновлена успішно!');
    }


    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Роль видалена успішно!');
    }

    public function updatePermissions(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Пермішени оновлено успішно!');
    }
}
