<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'username', // Assuming you're adding a username field
        'password', // Assuming you're adding a password field
        // You can add any other new attributes here
    ];

    /**
     * Get the user that owns the credential.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // If you plan to use Laravel's default authentication system for these credentials in the future,
    // you might also want to implement the \Illuminate\Contracts\Auth\Authenticatable in a custom way
    // or use a separate auth guard for these credentials.
}
