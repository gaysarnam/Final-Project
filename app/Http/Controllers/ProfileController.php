<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Booking; // ← Added: Import Booking model

class ProfileController extends Controller
{   
    public function show()
    {
        // ✅ Fetch logged-in user's bookings (latest first)
        $bookings = Booking::where('user_id', Auth::id())
                          ->orderBy('booking_date', 'desc')
                          ->orderBy('created_at', 'desc')
                          ->get();

        // Check if the logged-in user is Admin (usertype 1)
        if (Auth::user()->usertype == '1') {
            return view('admin.profile-view', compact('bookings')); // ← Added: pass bookings
        }

        // Otherwise, load the regular user design
        return view('profile-view', compact('bookings')); // ← Added: pass bookings
    }

    public function edit()
    {
        // Added logic for Admin Edit Page
        if (Auth::user()->usertype == '1') {
            return view('admin.profile-edit');
        }

        return view('profile-edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required',
            'new_password' => 'nullable|min:8',
        ]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('custom.profile.show');
    }
}