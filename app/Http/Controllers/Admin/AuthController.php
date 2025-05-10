<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if ($user->status != 1) {
                Auth::logout();
                return response()->json([
                    'success' => false,
                    'message' => 'Your account is inactive. Please contact the administrator.',
                ], 403);
            }

            $token = $user->createToken('xiphoid_pharma')->plainTextToken;

           $data = $user->only(['name', 'email']);

            return response()->json([
                'success' => true,
                'message' => 'User logged in successfully.',
                'data' => [
                    'user' => $data,
                    'token' => $token,
                ]
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials.',
        ], 401);
    }
}
