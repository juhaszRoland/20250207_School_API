<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request){
        $validated = $request->validated();

        $user = User::create($validated);
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(LoginUserRequest $request) {
        $validated = $request->validated();
        if (!Auth::attempt($validated)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        /** @var User $user **/
        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }
}
