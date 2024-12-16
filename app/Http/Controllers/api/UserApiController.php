<?php

namespace App\Http\Controllers\api;

use App\Contracts\Services\UserService\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateApiRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Contracts\Container\BindingResolutionException;

class UserApiController extends Controller
{

    /**
     * UserApiController constructor.
     *
     * Initializes the UserApiController with the provided UserService and Request instances.
     *
     * @param UserService $userService The UserService instance for handling user-related operations.
     * @param Request $request The Request instance for handling incoming HTTP requests.
     *
     * @return void
     *
     */
    public function __construct(
        protected UserService $userService,
        Request               $request
    )
    {
        if (!$request->expectsJson()) {
            abort(406);
        }
    }


    /**
     * Retrieves the authenticated user's information.
     *
     * This function is responsible for retrieving the authenticated user's data and returning it as a UserResource.
     * It first authorizes the action using the 'viewAny' policy, ensuring that the authenticated user has the necessary permissions.
     * Then, it retrieves the authenticated user's data using Laravel's auth()->user() method and returns it as a UserResource.
     *
     * @return UserResource The authenticated user's data wrapped in a UserResource.
     */
    public function index()
    {
        $this->authorizeAction('viewAny');
        return new UserResource(auth()->user());
    }


    /**
     * Updates the authenticated user's information.
     *
     * This function handles the user update process for the authenticated user. It first authorizes the 'update' action,
     * then extracts the necessary data from the request, handles image upload if present, and updates the user using the
     * UserService. Finally, it returns the updated user data wrapped in a UserResource.
     *
     * @param UserUpdateApiRequest $request The request containing the user data to be updated.
     *
     * @return UserResource The updated user data wrapped in a UserResource.
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
