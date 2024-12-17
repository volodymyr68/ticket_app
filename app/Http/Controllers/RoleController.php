<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Requests\RoleRequestUpdate;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\View|View
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        return view('roles.index', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return RedirectResponse
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create($request->only('name'));

        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Роль створена успішно!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|Application|View
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return Application|Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\View|View
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequestUpdate $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(RoleRequestUpdate $request, Role $role)
    {
        $role->update($request->only('name'));

        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')->with('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return RedirectResponse
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success');
    }
}
