<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Determine if the current user is an admin and if not, redirect them.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and if the user is an admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // If the user is not an admin, you can redirect them to a different page
        // or return an error response. Here's how you might redirect to the home page:
        return redirect('/')->with('error', 'You do not have access to this area');
        
        // Alternatively, you could return a 403 Forbidden response:
        // abort(403, 'Unauthorized action.');
    }
}
