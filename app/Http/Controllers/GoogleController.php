<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Exception;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('google_id', $googleUser->id)->first();

            if (!$user) {
                $user = User::where('email', $googleUser->email)->first();

                if ($user) {
                    $user->update(['google_id' => $googleUser->id]);
                } else {
                    // SPLIT GOOGLE NAME INTO FIRST AND LAST NAME
                    $nameParts = explode(' ', $googleUser->name, 2);
                    $firstName = $nameParts[0];
                    $lastName = isset($nameParts[1]) ? $nameParts[1] : ' ';

                    $user = User::create([
                        'first_name' => $firstName,
                        'last_name'  => $lastName,
                        'email'      => $googleUser->email,
                        'google_id'  => $googleUser->id,
                        'usertype'   => '0', // Set default user type
                        'password'   => Hash::make(Str::random(24)),
                    ]);
                }
            }

            Auth::login($user);
            
            // Redirect based on user type
            return ($user->usertype == '1') 
                ? redirect()->route('admin.dashboard') 
                : redirect()->route('dashboard');

        } catch (Exception $e) {
            // This will now show you the ACTUAL error if it fails again
            return redirect('/login')->withErrors(['msg' => 'Google Error: ' . $e->getMessage()]);
        }
    }
}