<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureTwoFactorChallenge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
{
    $user = Auth::user();

    // Check if the user is already on the two-factor setup page or two-factor challenge page
    if ($request->is('two-factor-challenge', 'profile/*')) {
        return $next($request);
    }

    // Redirect if 2FA is required and not verified
    if ($user && $user->two_factor_secret && !$user->hasVerifiedTwoFactor()) {
        return redirect()->route('two-factor-challenge.auth');
    }

    return $next($request);
}
}
