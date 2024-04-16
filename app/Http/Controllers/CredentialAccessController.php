<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
            abort(403, 'Unauthorized access - the link is invalid or has expired.');
        }

        // Fetch the credentials
        $credentials = $user->credentials; // Ensure the 'credentials' relationship is defined in the User model

        // Return the custom view for secure credentials
        return view('credentials.secure_credentials', compact('credentials'));
    }
}
