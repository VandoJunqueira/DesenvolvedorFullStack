<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function show()
    {
        try {
            return response()->json(auth()->user(), 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], $th->getCode() ?: 505);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request)
    {
        try {
            $user = User::find(auth()->user()->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->avatar = $request->avatar;

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return response()->json($user, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], $th->getCode() ?: 505);
        }
    }
}
