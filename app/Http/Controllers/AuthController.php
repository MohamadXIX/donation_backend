<?php

namespace App\Http\Controllers;

use App\Models\Ngo;
use App\Models\User;
use App\Models\Donor;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|string',
    //         'type' => 'required|in:user,ngo,donor', // Specify user type
    //     ]);

    //     $credentials = $request->only('email', 'password');

    //     // Determine the guard based on the user type
    //     $guard = $request->type;

    //     if (Auth::guard($guard)->attempt($credentials)) {
    //         $user = Auth::guard($guard)->user();
    //         $token = $user->createToken('auth-token')->plainTextToken;

    //         return response()->json([
    //             'token' => $token,
    //             'user' => $user,
    //         ]);
    //     }

    //     return response()->json(['message' => 'Invalid credentials'], 401);
    // }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!$token = JWTAuth::attempt($credentials)){
            return response(['Incorrect email or password'], 403);
        }

        $user = Auth::user();

        // $decryptedToken = $user->createToken($user->id)->plainTextToken;
        // $encryptedToken = encrypt($decryptedToken);

        $cookie = cookie('jwt', $token);

        return response(
            [
                'user' => $user,
                'token'=> $token

            ])->withCookie($cookie);

    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
