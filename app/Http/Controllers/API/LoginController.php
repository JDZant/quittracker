<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(['token' => $token]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function doesTestingWork(){
        return 'test';
    }
}
