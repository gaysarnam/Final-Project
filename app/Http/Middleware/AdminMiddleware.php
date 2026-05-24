<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <--- ADD THIS LINE
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Now Auth::check() will work because we imported the Facade above
        if (Auth::check() && Auth::user()->usertype == '1') {
            return $next($request);
        }

        // If not admin, send back to dashboard with an error message
        return redirect('dashboard')->with('error', 'You do not have admin access.');
    }
}