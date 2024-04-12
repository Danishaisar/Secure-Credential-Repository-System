<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     * Apply authentication middleware to all methods.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle initial dashboard routing based on user role.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function handleDashboard()
    {
        if (Auth::user()->role === 'admin') {
            return $this->adminDashboard();
        }
        return $this->userDashboard();
    }

    /**
     * Show the user dashboard.
     * @return \Illuminate\View\View
     */
    public function userDashboard()
    {
        return view('user.dashboard');
    }

    /**
     * Show the admin dashboard.
     * Only allow admins to access this page.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function adminDashboard()
    {
        if (Auth::user()->role !== 'admin') {
            // Redirect users who are not admins
            return redirect('/dashboard')->with('error', 'You do not have access to this area.');
        }

        return view('admin.dashboard');
    }
}
