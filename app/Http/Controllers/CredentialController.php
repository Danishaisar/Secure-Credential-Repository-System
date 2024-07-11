<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CredentialUpdatedNotification;
use App\Helpers\AuditLogHelper; // Import the AuditLogHelper
use ZxcvbnPhp\Zxcvbn;
use Illuminate\Support\Str;

class CredentialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $credentials = Auth::user()->credentials()
                         ->when($search, function ($query) use ($search) {
                             return $query->where(function($query) use ($search) {
                                 $query->where('name', 'like', '%' . $search . '%')
                                       ->orWhere('description', 'like', '%' . $search . '%');
                             });
                         })
                         ->get();
    
        return view('credentials.index', compact('credentials', 'search'));
    }

    public function create()
    {
        return view('credentials.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:credentials,username,NULL,id,user_id,' . Auth::id(),
            'password' => 'required|string|min:6',
            'description' => 'required|string',
        ]);

        // Note: No need to manually encrypt the password here, it's handled by the model
        $credential = Auth::user()->credentials()->create($validatedData);

        // Log the action
        AuditLogHelper::log('Created credential', "Created credential with name: {$credential->name}");

        return redirect()->route('credentials.index')->with('success', 'Credential created successfully.');
    }

    public function show(Credential $credential)
    {
        $this->authorize('view', $credential);
        $decryptedPassword = $credential->password;

        // Use zxcvbn to evaluate the password strength
        $zxcvbn = new Zxcvbn();
        $strength = $zxcvbn->passwordStrength($decryptedPassword);

        // Determine the status and suggest a stronger password if necessary
        $status = '';
        $suggestedPassword = '';
        if ($strength['score'] < 2) {
            $status = 'Your password is weak. It is recommended to change this credential password to avoid data breach.';
            $suggestedPassword = $this->generateStrongPassword($decryptedPassword);
        } elseif ($strength['score'] < 3) {
            $status = 'Your password is fair. Consider strengthening your password for better security.';
            $suggestedPassword = $this->generateStrongPassword($decryptedPassword);
        } elseif ($strength['score'] < 4) {
            $status = 'Your password is good. It is quite secure, but there is always room for improvement.';
        } else {
            $status = 'Your password is strong. Keep up the good security practices!';
        }

        return view('credentials.show', compact('credential', 'strength', 'status', 'suggestedPassword'));
    }


    public function edit(Credential $credential)
    {
        $this->authorize('update', $credential);
        return view('credentials.edit', compact('credential'));
    }

    public function update(Request $request, Credential $credential)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('credentials')->ignore($credential->id)->where('user_id', Auth::id()),
            ],
            'password' => 'nullable|string|min:6',
            'description' => 'required|string',
        ]);

        // Update credential details
        $credential->update($request->only('name', 'username', 'description'));

        // Update the password only if a new one is provided
        if ($request->filled('password')) {
            $credential->password = $request->password;
            $credential->save();
        }

        // Retrieve user's family info
        $familyInfo = Auth::user()->familyInfo;

        // Notify the user
        Notification::route('mail', Auth::user()->email)->notify(new CredentialUpdatedNotification($credential, Auth::user()));

        // Notify close kin if family info exists
        if ($familyInfo) {
            $kinEmails = collect([$familyInfo->kin_email_1, $familyInfo->kin_email_2, $familyInfo->kin_email_3])
                          ->filter();

            foreach ($kinEmails as $email) {
                Notification::route('mail', $email)->notify(new CredentialUpdatedNotification($credential, Auth::user()));
            }
        }

        // Log the action
        AuditLogHelper::log('Updated credential', "Updated credential with name: {$credential->name}");

        return redirect()->route('credentials.index')->with('success', 'Credential updated successfully.');
    }

    public function destroy(Credential $credential)
    {
        $this->authorize('delete', $credential);
        $credential->delete();

        // Log the action
        AuditLogHelper::log('Deleted credential', "Deleted credential with name: {$credential->name}");

        return back()->with('success', 'Credential deleted successfully.');
    }

    public function encrypt(Credential $credential)
    {
        $this->authorize('update', $credential);

        // Get the decrypted value (handled by the accessor)
        $decryptedPassword = $credential->password;

        // Get the original encrypted value directly from the database, bypassing the accessor
        $encryptedPassword = $credential->getRawOriginal('password');

        // Log the action
        AuditLogHelper::log('Verified encryption', "Verified encrypted password for credential with name: {$credential->name}");

        return redirect()->route('credentials.show', $credential)
                        ->with('decryptedPassword', $decryptedPassword)
                        ->with('encryptedPassword', $encryptedPassword);
    }

    public function checkPasswordStrength(Request $request)
    {
        $password = $request->input('password');

        // Use zxcvbn to evaluate the password
        $zxcvbn = new Zxcvbn();
        $strength = $zxcvbn->passwordStrength($password);

        return response()->json($strength);
    }

    private function generateStrongPassword($currentPassword)
    {
        // Replace certain characters to make the password stronger
        $replacements = [
            'a' => '@',
            'i' => '!',
            'o' => '0',
            'l' => '1',
            's' => '$'
        ];

        $newPassword = strtr($currentPassword, $replacements);

        // Ensure the new password has at least 1 uppercase letter, 1 lowercase letter, 1 digit, and 1 special character
        if (!preg_match('/[A-Z]/', $newPassword)) {
            $newPassword .= 'A';
        }
        if (!preg_match('/[a-z]/', $newPassword)) {
            $newPassword .= 'a';
        }
        if (!preg_match('/[0-9]/', $newPassword)) {
            $newPassword .= '1';
        }
        if (!preg_match('/[\W]/', $newPassword)) {
            $newPassword .= '@';
        }

        // Check if the new password is strong enough
        $zxcvbn = new Zxcvbn();
        $strength = $zxcvbn->passwordStrength($newPassword);

        while ($strength['score'] < 3) {
            $newPassword .= str_shuffle('!@#$%^&*()_+-=0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz')[0];
            $strength = $zxcvbn->passwordStrength($newPassword);
        }

        return $newPassword;
    }
}
