<?php

namespace App\Http\Controllers\api;

use App\Contracts\Services\UserService\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateApiRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService, Request $request)
    {
        if (!$request->expectsJson()) {
            abort(406);
        }
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorizeAction('viewAny');
        return new UserResource(auth()->user());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateApiRequest $request)
    {
        $this->authorizeAction('update');
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('user_images', 'public');
        }
        $updatedUser = $this->userService->update(auth()->user(), $data);

        return new UserResource($updatedUser);
    }
}
