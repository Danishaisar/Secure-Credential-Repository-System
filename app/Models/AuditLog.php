<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'action', 'details'];

    /**
     * Define the relationship to the User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Optionally, you can specify the table name if it doesn't follow Laravel's naming convention
    // protected $table = 'audit_logs';
}
