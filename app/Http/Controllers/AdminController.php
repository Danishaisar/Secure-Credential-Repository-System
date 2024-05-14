<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\SendCredentialAccessLink;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\Feedback;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', '<>', 'admin')->where('is_deceased', false)->get();
        $deceasedUsers = User::where('is_deceased', true)->get(); // Fetching deceased users

        return view('user.index', compact('users', 'deceasedUsers'));
    }


    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

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
        $request->validate([
            'name' => 'required|max:255',
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
        ]);

        $user->update($request->only('name', 'email'));
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
    $user->is_deceased = true;
    $user->save();

    $familyInfo = $user->familyInfo;
    if ($familyInfo) {
        $emails = collect([$familyInfo->kin_email_1, $familyInfo->kin_email_2, $familyInfo->kin_email_3])
                    ->filter()
                    ->all();  // Collect and convert to array

        if (empty($emails)) {
            return back()->with('error', 'No kin emails available to send the credentials.');
        }

        $token = $user->generateSecureAccessLink();
        $link = route('kin.access', ['user' => $user->id, 'token' => $token]);

        // Correctly pass the array of emails
        Mail::to($emails)->send(new SendCredentialAccessLink($emails, $link, $user->name));

        return back()->with('success', 'User marked as deceased and secure link sent to close kin.');
    }

    return back()->with('success', 'User marked as deceased successfully.');
}

// New method to display feedback
public function showFeedback()
{
    $feedbacks = Feedback::all(); // Fetch all feedback
    return view('admin.feedback.index', compact('feedbacks'));
}
}
