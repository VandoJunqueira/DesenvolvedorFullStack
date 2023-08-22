<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        if (!auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }

        $token = auth()->user()->createToken('access_token')->plainTextToken;


        return response()->json(['user' => auth()->user(), 'token' => $token, 'status' => true], 200);
    }

    public function signUp()
    {
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Logout successful'], 200);
    }
}
