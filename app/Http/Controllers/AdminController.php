<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\SendCredentialAccessLink; // Make sure to use the correct name of the mail class
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
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
        $credentials = $user->credentials; // Ensure this relationship exists
        return view('admin.show_credentials', compact('user', 'credentials'));
    }

    public function markUserAsDeceased(User $user)
    {
        // Mark the user as deceased in the database
        $user->is_deceased = true;
        $user->save();

        // Generate a secure access link for the close kin
        $token = $user->generateSecureAccessLink();
        $link = route('kin.access', ['user' => $user->id, 'token' => $token]);

        // Send an email with the secure link instead of credentials directly
        Mail::to($user->close_kin_email)->send(new SendCredentialAccessLink($link));

        return back()->with('success', 'User marked as deceased and secure link sent to close kin.');
    }
}
