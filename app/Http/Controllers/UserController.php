<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\RoleService\RoleService;
use App\Services\UserService\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    protected $roleService;

    public function __construct(UserService $userService,RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Фильтры
        if ($request->filled('role')) {
            $query->whereHas('role', function ($q) use ($request) {
                $q->where('name', $request->input('role'));
            });
        }

        if ($request->filled('sex')) {
            $query->where('sex', $request->input('sex'));
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%')
                ->orWhere('email', 'like', '%' . $request->input('search') . '%');
        }

        // Сортировка
        $sortableFields = ['name', 'email', 'number'];
        $sortField = $request->input('sort', 'id');
        $sortDirection = $request->input('direction', 'asc');

        if (in_array($sortField, $sortableFields)) {
            $query->orderBy($sortField, $sortDirection);
        }

        $users = $query->paginate(10)->appends($request->query());
        $roles = Role::all(); // Предположительно, у вас есть таблица ролей
        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!$this->authorize('create', User::class)){
            abort(403);
        }
        $roles = $this->roleService->getAll();
        return view('users.create',['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        if(!$this->authorize('create', User::class)){
            abort(403);
        }
        $user = $this->userService->create($request->all());
        return redirect()->route('user.show',[$user]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if(!$this->authorize('view', $user)){
            abort(403);
        }
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if(!$this->authorize('update', $user)){
            abort(403);
        }
        $roles = Role::all();
        return view('users.edit', ['user' => $user,'roles'=>$roles]);
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
        $updatedUser = $this->userService->update($user,$data);
        if ($updatedUser) {
            return redirect()->route('user.show', [$user->id]);
        }
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
