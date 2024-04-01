<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\CredentialsMail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        // Assuming 'role' is the column name and 'user' signifies a non-admin user.
        // Adjust the 'user' value based on your actual non-admin role identifier.
        $users = User::where('role', '<>', 'admin')->get();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);
        
        $validatedData['password'] = bcrypt($validatedData['password']);
        
        User::create($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        
        $user->update($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    public function showCredentials(User $user)
    {
        $credentials = $user->credentials; // Make sure this relationship exists in your User model
        return view('admin.show_credentials', compact('user', 'credentials'));
    }

    public function markUserAsDeceased(User $user)
{
    // Mark the user as deceased in the database
    $user->is_deceased = true;
    $user->save();

    // Assuming you have a method on the User model to fetch credentials
    $credentials = $user->credentials;

    // Now, implement step 3: Send an email to the close kin with the credentials
    Mail::to($user->close_kin_email)->send(new CredentialsMail($user, $credentials));

    return back()->with('success', 'User marked as deceased and credentials sent to close kin.');
}
}
