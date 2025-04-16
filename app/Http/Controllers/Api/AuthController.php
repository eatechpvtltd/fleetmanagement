<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;


class AuthController extends BaseController
{

    public function login(Request $request)
    {
        return $request;
        // Validate request inputs
        $request->validate([
            'email' => 'required',
            'password' => 'required',
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
    // public function login(Request $request):JsonResponse
    // {
    //     if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
    //         $user = Auth::user(); 
    //         $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
    //         $success['name'] =  $user->name;
   
    //         return $this->sendResponse($success, 'User login successfully.');
    //     } 
    //     else{ 
    //         return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
    //     } 
    }

}
