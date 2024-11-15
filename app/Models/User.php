<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Helpers\AuditLogHelper; // Import the AuditLogHelper

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
        'google2fa_secret',   // Stores the Google 2FA secret key
        'secure_token',       // Secure token for close kin access
        'token_expires_at',    // Expiration time for the secure token
        'mfa_verified',
        'agreement_video',
        'selected_kin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'secure_token',       // Hide secure token from array/json output
        'google2fa_secret'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'mfa_expires_at' => 'datetime', // Ensures proper casting for datetime
        'token_expires_at' => 'datetime', // Casting token expiration as datetime
        'google2fa_secret' => 'string', // Ensures google2fa_secret is handled as a string
        'mfa_verified' => 'boolean',
        'selected_kin' => 'array' // Cast selected_kin as array
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

        // Log the action
        AuditLogHelper::log('Sent credentials to close kin', "Sent credentials to {$this->close_kin_email}");
    }

    // Generate a secure, one-time use token for close kin access
    public function generateSecureAccessLink()
    {
        $token = Str::random(40); // Generate a random token
        $this->update([
            'secure_token' => Hash::make($token),
            'token_expires_at' => now()->addHours(24) // token expires in 24 hours
        ]);

        // Log the action
        AuditLogHelper::log('Generated secure access link', "Generated secure access link for {$this->close_kin_email}");

        return $token;
    }

    public function familyInfo()
    {
        return $this->hasOne(FamilyInfo::class);
    }

    // Validate the token
    public function tokenIsValid($token)
    {
        return Hash::check($token, $this->secure_token) && now()->lessThan($this->token_expires_at);
    }
}
