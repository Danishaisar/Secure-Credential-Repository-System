<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class CredentialAccessController extends Controller
{
    /**
     * Access the credentials by a secure link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function accessCredentials(Request $request, $user_id, $token)
    {
        $user = User::findOrFail($user_id);

        // Check if the token is valid
        if (!$user->tokenIsValid($token)) {
            Log::warning("Failed credential access attempt for User ID: {$user_id}");
            return redirect()->to('/error')->with('error', 'The link is invalid or has expired.');
        }

        // Log successful access
        Log::info("Credential accessed successfully via secure link for User ID: {$user_id}");

        // Fetch the credentials
        $credentials = $user->credentials; // Ensure the 'credentials' relationship is defined in the User model

        // Return the custom view for secure credentials
        return view('credentials.secure_credentials', compact('credentials'));
    }

    /**
     * Show the secure credentials view.
     *
     * @param  int  $user_id
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function showSecureCredentials($user_id, $token)
    {
        $user = User::findOrFail($user_id);

        // Check if the token is valid
        if (!$user->tokenIsValid($token)) {
            Log::warning("Failed credential access attempt for User ID: {$user_id}");
            return redirect()->to('/error')->with('error', 'The link is invalid or has expired.');
        }

        // Fetch the credentials
        $credentials = $user->credentials; // Ensure the 'credentials' relationship is defined in the User model

        // Return the secure credentials view
        return view('credentials.secure_credentials', compact('credentials'));
    }
}
