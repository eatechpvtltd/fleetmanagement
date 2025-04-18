<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail as FacadesMail;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    // public function showConfirmForm()
    // {
    //     return view('auth.confirm-password');
    // }
    public function showConfirmForm($hashed_id)
    {
        // $hashed_id1 = $hashed_id;
        return view('auth.confirm-password', compact('hashed_id'));
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
    
        $otp = random_int(100000, 999999);
        $user = User::where('email', $request->email)->first();
    
        // Store OTP and expiration in users table
        $user->update([
            'reset_otp' => $otp,
            'reset_otp_expires_at' => now()->addMinutes(15), // OTP valid for 15 minutes
        ]);
    
       // Generate a hashed user ID
        $hashedUserId = encrypt($user->id); // Using encryption for reversible ID
        $resetLink = route('confirm.request', ['hashed_id' => $hashedUserId]);

        $mailData = [
            'title' => 'Password Reset Request',
            'user' => $user->name ?? 'User',
            'reset_link' => $resetLink,
        ];
    
        try {
            FacadesMail::to($request->email)->send(new ForgotPasswordMail($mailData));
            
            // Generate a hashed user ID
            $hashedUserId = encrypt($user->id); // Combine ID with timestamp for uniqueness
            return redirect()->route('forgot-password-success', [
                'success' => 2,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['email' => 'Failed to send email: ' . $e->getMessage()]);
            // return response()->json([
            //     'success' => false,
            //     'message' => 'Failed to send email: ' . $e->getMessage(),
            // ], 500);
        }
    }

    public function resetPassword(Request $request,$hashed_id)
    {
        // Validate the request
        $request->validate([
            'hashed_id' => 'required',
            'password' => 'required', // You might also want to validate min:6 or confirmed
        ]);
    
        // Try to decrypt hashed_id
        try {
            $userId = decrypt($hashed_id);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'reset_link' => route('password.request', ['message' => 'Invalid or expired reset link.']),
                'message' => 'Invalid or expired reset link.',
            ], 400);
        }
    
        // Find the user
        $user = User::find($userId);
       
        if (!$user) {
            return response()->json([
                'success' => false,
                'reset_link' => route('password.request', ['message' => 'Invalid or expired reset link.']),
                'message' => 'User not found.',
            ], 404);
        }
    
        // Update password
        $user->password = Hash::make($request->password);
        $user->save();
    
        // Return JSON response
        return response()->json([
            'success' => 2,
            'reset_link' => route('password-changed-success', ['success' => 2]),
            'message' => 'Password reset successfully. Please log in.',
        ], 200);
    }
    
}
