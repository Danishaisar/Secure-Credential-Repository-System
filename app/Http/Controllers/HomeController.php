<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\AuditLogHelper; // Import the AuditLogHelper

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function handleDashboard()
    {
        $role = Auth::user()->role;
        
        if ($role === 'superadmin') {
            AuditLogHelper::log('Accessed super admin dashboard');
            return $this->superAdminDashboard();
        } elseif ($role === 'admin') {
            AuditLogHelper::log('Accessed admin dashboard');
            return $this->adminDashboard();
        }
        AuditLogHelper::log('Accessed user dashboard');
        return $this->userDashboard();
    }

    public function userDashboard()
    {
        return view('user.dashboard');
    }

    public function adminDashboard()
    {
        if (Auth::user()->role !== 'admin') {
            // Redirect users who are not admins
            return redirect('/dashboard')->with('error', 'You do not have access to this area.');
        }
        return view('admin.dashboard');
    }

    public function superAdminDashboard()
    {
        if (Auth::user()->role !== 'superadmin') {
            // Redirect users who are not superadmins
            return redirect('/dashboard')->with('error', 'You do not have access to this area.');
        }
        return view('superadmin.dashboard');
    }
}
