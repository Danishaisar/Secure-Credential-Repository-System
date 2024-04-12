<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Mail\CredentialsMail; // Ensure this matches the namespace of your mailable
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'close_kin_email',
        'mfa_code',           // Handles MFA code
        'mfa_expires_at',     // Handles MFA code expiration
        'google2fa_secret'    // Stores the Google 2FA secret key
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'mfa_expires_at' => 'datetime', // Ensures proper casting for datetime
        'google2fa_secret' => 'string', // Ensures google2fa_secret is handled as a string
    ];

    public function credentials()
    {
        return $this->hasMany(Credential::class);
    }

    public function sendCredentialsToCloseKin()
    {
        $credentialsForEmail = $this->credentials->map(function ($credential) {
            return "Credential: {$credential->name}, Username: {$credential->username}, Password: {$credential->password}";
        })->implode("\n");

        Mail::to($this->close_kin_email)->send(new CredentialsMail($this, $credentialsForEmail));
    }
}
