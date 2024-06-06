<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\DeathCertificate;
use App\Models\AuditLog;
use App\Helpers\AuditLogHelper;

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

        // Retrieve necessary data for admin dashboard
        $users = User::where('role', '!=', 'admin')->where('is_deceased', false)->get();
        $deceasedUsers = User::where('is_deceased', true)->get();
        $pendingDeathCertificatesCount = DeathCertificate::where('verified', false)->count();
        $recentActivities = AuditLog::latest()->take(3)->get();

        return view('admin.dashboard', compact('users', 'deceasedUsers', 'pendingDeathCertificatesCount', 'recentActivities'));
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
