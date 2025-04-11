<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        // Validate request inputs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        try {
            // Attempt to generate JWT token
            if (!$token = Auth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credentials'
                ], 401);
            }

            // Get the authenticated user
            $user = Auth::user();
            
            // Generate a random token and store it in remember_token
            $randomToken = bin2hex(random_bytes(32));
            $user->remember_token = $randomToken;
            $user->save();

            // Login the user into the Laravel Auth system
            Auth::login($user);

            return response()->json([
                'success' => true,
                'token' => $token,        
                'remember_token' => $randomToken,
                'user' => $user,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Could not create token',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
