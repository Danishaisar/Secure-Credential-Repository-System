<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CredentialUpdatedNotification;
use App\Helpers\AuditLogHelper; // Import the AuditLogHelper

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
        return view('credentials.show', compact('credential'));
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
}
