<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index()
    {
        // Fetch all audit logs with associated user details
        $auditLogs = AuditLog::with('user')->get();

        // Pass the logs to a view
        return view('audit_logs.index', compact('auditLogs'));
    }

    public function show($id)
    {
        // Fetch a specific audit log with associated user details
        $auditLog = AuditLog::with('user')->findOrFail($id);

        // Pass the log to a view
        return view('audit_logs.show', compact('auditLog'));
    }
}
