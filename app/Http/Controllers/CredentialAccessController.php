<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\AuditLogHelper;

class CredentialAccessController extends Controller
{
        public function accessCredentials(Request $request, $user_id, $token)
    {
        $user = User::findOrFail($user_id);

        // Check if the token is valid
        if (!$user->tokenIsValid($token)) {
            Log::warning("Failed credential access attempt for User ID: {$user_id}");
            AuditLogHelper::log('Failed credential access attempt', "Failed access attempt for User ID: {$user_id}");
            return redirect()->to('/error')->with('error', 'The link is invalid or has expired.');
        }

        // Log successful access
        Log::info("Credential accessed successfully via secure link for User ID: {$user_id}");
        AuditLogHelper::log('Accessed credentials', "Accessed credentials for User ID: {$user_id}");

        // Fetch the credentials
        $credentials = $user->credentials;

        // Check if the current user is allowed to view the agreement video
        $currentUserEmail = $request->input('email'); // Assume the current user's email is passed in the request
        $canViewVideo = in_array($currentUserEmail, $user->selected_kin);

        // Return the custom view for secure credentials
        return view('credentials.secure_credentials', compact('credentials', 'canViewVideo', 'user'));
    }

}
