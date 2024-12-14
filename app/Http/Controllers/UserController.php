<?php

namespace App\Http\Controllers;

use App\Contracts\Services\RoleService\RoleService;
use App\Contracts\Services\UserService\UserService;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{


    public function __construct(
        protected UserService $userService,
        protected RoleService $roleService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['role', 'sex', 'search']);
        $users = $this->userService->getSortedUsers($filters, 10);
        $roles = $this->roleService->getAll();

        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (!$this->authorize('view', $user)) {
            abort(403);
        }
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (!$this->authorize('update', $user)) {
            abort(403);
        }
        $roles = Role::all();
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (!$this->authorize('update', auth()->user())) {
            abort(403);
        }
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('user_images', 'public');
        }
        $updatedUser = $this->userService->update($user, $data);

        return redirect()->route('user.show', [$updatedUser->id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        if (!$this->authorize('create', User::class)) {
            abort(403);
        }
        $user = $this->userService->create($request->all());
        return redirect()->route('user.show', [$user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!$this->authorize('create', User::class)) {
            abort(403);
        }
        $roles = $this->roleService->getAll();
        return view('users.create', ['roles' => $roles]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index');
    }
}
