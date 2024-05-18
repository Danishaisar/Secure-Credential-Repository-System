<?php

namespace App\Helpers;

use App\Models\AuditLog;

class AuditLogHelper
{
    public static function log($action, $details = null)
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'details' => $details,
        ]);
    }
}
