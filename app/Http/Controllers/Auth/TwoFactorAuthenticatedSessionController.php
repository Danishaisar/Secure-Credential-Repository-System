<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthenticatedSessionController extends Controller
{
    /**
     * Show the two-factor authentication challenge form.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            // Redirect to login if not authenticated
            return redirect()->route('login');
        }

        // Check if the user has 2FA enabled but hasn't completed the 2FA challenge yet
        $user = Auth::user();
        if (!$user->two_factor_secret || session('two_factor_authenticated', false)) {
            // Redirect to the dashboard if 2FA is not enabled or already completed
            return redirect()->route('dashboard');
        }

        // Show the two-factor challenge view if 2FA is enabled and not yet verified in this session
        return view('auth.two-factor-challenge');
    }
}
