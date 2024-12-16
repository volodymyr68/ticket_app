<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Registers a new user.
     *
     * @param Request $request The request object containing the user's details.
     * @return JsonResponse The response containing the user's token and details.
     * @throws ValidationException If the request data fails validation.
     */
    public function register(Request $request)
    {
        $validateUser = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if ($validateUser->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'error' => $validateUser->errors()
            ], 422);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return response()->json([
            'token' => $user->createToken("API Token")->plainTextToken,
            'token_type' => 'Bearer',
            'user' => new UserResource($user)
        ], 201);
    }

    /**
     * Authenticates a user and returns their token.
     *
     * @param Request $request The request object containing the user's email and password.
     * @return JsonResponse The response containing the user's token and token type.
     * @throws ValidationException If the request data fails validation.
     * @throws AuthenticationException If the provided credentials are invalid.
     */
    public function login(Request $request)
    {
        $validateUser = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ]);
        if ($validateUser->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'error' => $validateUser->errors()
            ], 422);
        }
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        return response()->json([
            'token' => $user->createToken("API Token")->plainTextToken,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * Redirects the user to the main application after successful Google login.
     *
     * This function handles the redirection logic after a user has successfully authenticated
     * using Google. It checks if the 'google' query parameter is present and equals to 1.
     * If the conditions are met, it retrieves the user from the database using the 'user' query parameter,
     * generates an API token for the user, creates a cookie with the token, and redirects the user
     * to the main application with the cookie and user data.
     *
     * @param Request $request The request object containing the query parameters.
     * @return RedirectResponse The redirect response to the main application.
     */
    public function loginRedirect(Request $request)
    {
        if ($request->query('google') !== null && $request->query('google') == 1) {

            $user = User::where('id', $request->query('user'))->first();
            $token = $user->createToken("API Token")->plainTextToken;
            $cookie = cookie('apiToken', $token, 60 * 24, null, null, false, false);

            return redirect('http://localhost:5173/')
                ->withCookie($cookie)
                ->with('user', new UserResource($user));
        }
        return redirect('http://localhost:5173/');
    }
}
