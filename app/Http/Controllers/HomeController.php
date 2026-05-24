<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            
            // 1. Check if the user has been blocked by Admin
            if (Auth::user()->status === 'Blocked') {
                Auth::logout();
                
                // Invalidate the session to prevent them from hitting "Back"
                request()->session()->invalidate();
                request()->session()->regenerateToken();

                return redirect()->route('login')->withErrors([
                    'email' => 'Your account is blocked by admin.',
                ]);
            }

            // 2. Redirect based on User Type if NOT blocked
            $usertype = Auth::user()->usertype;

            if ($usertype == '1') {
                // If user is Admin, send to admin/dashboard
                return redirect()->route('admin.dashboard');
            } else {
                // If user is regular, send to /dashboard
                return redirect()->route('dashboard');
            }
        }

        return redirect()->route('login');
    }
}