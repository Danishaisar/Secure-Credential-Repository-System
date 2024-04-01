<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class HomeController extends Controller
    {
        /**
         * Create a new controller instance.
         */
        public function __construct()
        {
            $this->middleware('auth');
        }

        /**
         * Show the user dashboard.
         */
        public function userDashboard()
        {
            return view('user.dashboard');
        }

        /**
         * Show the admin dashboard.
         */
        public function adminDashboard()
        {
            // Optionally, ensure that only admins can access this page
            if (Auth::user()->role !== 'admin') {
                // Redirect users who are not admins
                return redirect('/')->with('error', 'You do not have access to this area.');
            }

            return view('admin.dashboard');
        }
    }
