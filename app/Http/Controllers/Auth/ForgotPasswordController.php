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
    public function showConfirmForm()
    {
        return view('auth.confirm-password');
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
            return redirect()->route('confirm.request', [
                'hashed_id' => $hashedUserId,
                'success' => true,
                'message' => 'Password reset OTP has been sent to your email.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send email: ' . $e->getMessage(),
            ], 500);
        }
    }

    // public function resetPassword(Request $request)
    // {
    //     $request->validate([
    //         'hashed_id' => 'required',
    //         'password' => 'required',
    //     ]);
        
    //     // Decode or decrypt the hashed_id (assuming you used encryption in sendResetLink)
    //     try {
    //         $userId = decrypt($request->hashed_id); 
    //     } catch (\Exception $e) {
    //         return back()->withErrors(['hashed_id' => 'Invalid or expired reset link.']);
    //     }

    //     // Find the user
    //     $user = User::find($userId);
        
    //     if (!$user) {
    //         return back()->withErrors(['hashed_id' => 'User not found.']);
    //     }

    //     // Update the password and clear OTP fields
    //     $user->update([
    //         'password' => Hash::make($request->password),
    //         'reset_otp' => null,
    //         'reset_otp_expires_at' => null,
    //     ]);

    //     // Redirect to login with success message
    //     return redirect()->back()->with('success', 'Password reset successfully. Please log in.');
    // }
    public function resetPassword(Request $request)
    {
        // Validate the request
        $request->validate([
            'hashed_id' => 'required',
            // 'otp' => 'required|numeric|digits:6',
            'password' => 'required', // Ensures password matches password_confirmation
        ]);

        // Decode or decrypt the hashed_id (assuming encryption was used in sendResetLink)
        try {
            $userId = decrypt($request->hashed_id); // Adjust based on how you hashed/encrypted
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired reset link.',
            ], 400);
        }

        // Find the user
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ], 404);
        }

        $user->password = Hash::make($request->password);
        $user->reset_otp = null;
        $user->reset_otp_expires_at = null;
        $user->save();

        // Verify OTP and expiration
        // if ($user->reset_otp !== $request->otp || now()->greaterThan($user->reset_otp_expires_at)) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Invalid or expired OTP.',
        //     ], 400);
        // }

        // Update the password and clear OTP fields
        // $user->update([
        //     'password' => Hash::make($request->password),
        //     'reset_otp' => null,
        //     'reset_otp_expires_at' => null,
        // ]);

        // Return JSON success response
        return response()->json([
            'success' => true,
            'message' => 'Password reset successfully. Please log in.',
        ], 200);
    }
}
