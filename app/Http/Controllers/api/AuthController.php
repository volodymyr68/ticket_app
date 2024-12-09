<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validateUser = Validator::make($request->all(),[
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users'],
            'password' => ['required','string','min:8'],
        ]);
        if($validateUser->fails()){
            return response()->json([
                'message' => 'Validation failed',
                'error' => $validateUser->errors()
            ], 422);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password)
        ]);
        return response()->json([
            'token' => $user->createToken("API Token")->plainTextToken,
            'token_type' => 'Bearer',
            'user' => new UserResource($user)
        ], 201);
    }

    public function login(Request $request){
        $validateUser = Validator::make($request->all(),[
            'email' => ['required','string','email'],
            'password' => ['required','string']
        ]);
        if($validateUser->fails()){
            return response()->json([
                'message' => 'Validation failed',
                'error' => $validateUser->errors()
            ], 422);
        }
        if(!auth()->attempt($request->only('email','password'))){
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = User::where('email',$request->email)->first();

        return response()->json([
            'token' => $user->createToken("API Token")->plainTextToken,
            'token_type' => 'Bearer',
        ]);
    }
}
