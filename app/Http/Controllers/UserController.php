<?php

namespace App\Http\Controllers;

use App\Contracts\Services\RoleServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{

    /**
     * Constructor for UserController.
     *
     * @param UserService $userService The service for managing user data.
     * @param RoleService $roleService The service for managing role data.
     */
    public function __construct(
        protected UserServiceInterface $userService,
        protected RoleServiceInterface $roleService
    )
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request The incoming request.
     * @return View The view for displaying the list of users.
     */
    public function index(Request $request)
    {
        $this->authorizeAction('viewAny');
        $filters = $request->only(['role', 'sex', 'search']);
        $users = $this->userService->getSortedUsers($filters, 10);
        $roles = $this->roleService->getAll();

        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user The user to be displayed.
     * @return View The view for displaying the specified user.
     */
    public function show(User $user)
    {
        $this->authorizeAction('view');
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user The user to be edited.
     * @return View The view for editing the specified user.
     */
    public function edit(User $user)
    {
        $this->authorizeAction('update');
        $roles = Role::all();
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request The incoming request.
     * @param User $user The user to be updated.
     * @return RedirectResponse Redirect to the user's show page.
     */
    public function update(Request $request, User $user)
    {
        $this->authorizeAction('update');
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('user_images', 'public');
        }
        $updatedUser = $this->userService->update($user, $data);

        return redirect()->route('user.show', [$updatedUser->id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request The incoming request.
     * @return RedirectResponse Redirect to the newly created user's show page.
     */
    public function store(UserRequest $request)
    {
        $this->authorizeAction('create');
        $user = $this->userService->create($request->all());
        return redirect()->route('user.show', [$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View The view for creating a new user.
     */
    public function create()
    {
        $this->authorizeAction('create');
        $roles = $this->roleService->getAll();
        return view('users.create', ['roles' => $roles]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user The user to be deleted.
     * @return RedirectResponse Redirect to the user index page.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index');
    }
}
