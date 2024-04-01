<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Mail\CredentialsMail; // Make sure this matches the namespace of your mailable
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'close_kin_email', // Ensure this attribute is correctly set up in your database
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the credentials for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function credentials()
    {
        return $this->hasMany(Credential::class);
    }

    /**
     * Send credentials to the close kin's email.
     *
     * @return void
     */
    public function sendCredentialsToCloseKin()
    {
        $credentialsForEmail = $this->credentials->map(function ($credential) {
            // Customize this formatting based on your Credential model's structure.
            // Ensure that any sensitive information is securely handled.
            return "Credential: {$credential->name}, Username: {$credential->username}, Password: {$credential->password}";
        })->implode("\n");

        // Send an email to the close kin with the credentials.
        // Make sure you have created the CredentialsMail mailable and its view.
        Mail::to($this->close_kin_email)->send(new CredentialsMail($this, $credentialsForEmail));
    }
}
