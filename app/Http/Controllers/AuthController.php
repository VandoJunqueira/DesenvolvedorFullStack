<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\AuthSingUpRequest;
use App\Models\User;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public UserServices $services;

    public function __construct(UserServices $services)
    {
        $this->services = $services;
    }

    public function login(AuthRequest $request)
    {
        if (!auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }

        $token = auth()->user()->createToken('access_token')->plainTextToken;

        return response()->json(['user' => auth()->user(), 'token' => $token, 'status' => true], 200);
    }

    public function signUp(AuthSingUpRequest $request)
    {
        try {
            $user = $this->services->store($request->all());

            $token = $user->createToken('access_token')->plainTextToken;

            return response()->json(['user' => $user, 'token' => $token, 'status' => true], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], $th->getCode() ?: 505);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Logout successful'], 200);
    }
}
