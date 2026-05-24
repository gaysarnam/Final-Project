<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'service' => 'required',
            'rating' => 'required|integer|between:1,5',
            'feedback' => 'required|max:100',
        ]);

        // This saves the feedback to the database
        Feedback::create([
            'user_id' => Auth::id(),
            'full_name' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
            'email' => Auth::user()->email,
            'service' => $request->service,
            'rating' => $request->rating,
            'feedback' => $request->feedback,
        ]);

        // Redirect back with a success message
        return back()->with('feedback_success', 'Thank you for your feedback!');
    }
}