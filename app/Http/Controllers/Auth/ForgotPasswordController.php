<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOTPMail;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    // Step 1: Show Email Form
    public function showEmailForm() { 
        return view('auth.forgot-password'); 
    }

    public function sendOTP(Request $request) {
        // Only allow registered emails
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'This email is not registered in our system.'
        ]);

        $otp = rand(100000, 999999);
        $user = User::where('email', $request->email)->first();
        
        // Save OTP and set expiry to 60 minutes to handle any timezone/lag issues
        $user->update([
            'otp' => $otp, 
            'otp_expires_at' => Carbon::now()->addHours(1) 
        ]);

        // Send the email
        Mail::to($user->email)->send(new SendOTPMail($otp));
        
        // Save email in session for next steps
        session(['reset_email' => $request->email]);

        return redirect()->route('otp.verify');
    }

    // Step 2: Show OTP Form
    public function showOTPForm() { 
        return view('auth.verify-otp'); 
    }

    public function verifyOTP(Request $request) {
        $request->validate(['otp' => 'required']);
        
        $email = session('reset_email');

        // Find the user by email from the session
        $user = User::where('email', $email)->first();

        // 1. Check if the OTP matches exactly
        if (!$user || $user->otp !== $request->otp) {
            return back()->withErrors(['otp' => 'The OTP code you entered is incorrect.']);
        }

        // 2. Check if the time has expired (using a robust comparison)
        if (Carbon::parse($user->otp_expires_at)->isPast()) {
            return back()->withErrors(['otp' => 'This OTP has expired. Please request a new one.']);
        }

        // If both match, proceed to the reset page
        return redirect()->route('password.reset.custom');
    }

    // Step 3: Show Reset Form
    public function showResetForm() { 
        // Security check: if user somehow reached here without session, send back
        if (!session()->has('reset_email')) {
            return redirect()->route('password.request');
        }
        return view('auth.reset-password'); 
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'password' => 'required|min:8|confirmed'
        ], [
            'password.confirmed' => 'The passwords do not match.'
        ]);

        $user = User::where('email', session('reset_email'))->first();
        
        if ($user) {
            $user->update([
                'password' => Hash::make($request->password), 
                'otp' => null, 
                'otp_expires_at' => null
            ]);
            
            session()->forget('reset_email');
            return redirect()->route('login')->with('status', 'Your password has been reset successfully!');
        }

        return redirect()->route('password.request');
    }
}