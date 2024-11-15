<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Feedback;
use App\Models\Complaint;
use App\Models\DeathCertificate; 
use App\Mail\SendCredentialAccessLink;
use App\Mail\DeathCertificateVerifiedMail; 
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Helpers\AuditLogHelper; 

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::where('role', 'user')
            ->where('is_deceased', false)
            ->when($search, function ($query, $search) {
                return $query->where(function($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                          ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->get();

        $deceasedUsers = User::where('role', 'user')
            ->where('is_deceased', true)
            ->when($search, function ($query, $search) {
                return $query->where(function($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                          ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->get();

        return view('user.index', compact('users', 'deceasedUsers', 'search'));
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

        // Log the action
        AuditLogHelper::log('Created user', "Created user with email: {$request->email}");

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

        // Log the action
        AuditLogHelper::log('Updated user', "Updated user with email: {$user->email}");

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        // Log the action
        AuditLogHelper::log('Deleted user', "Deleted user with email: {$user->email}");

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

        // Log the action
        AuditLogHelper::log('Marked user as deceased', "Marked user with email: {$user->email} as deceased");

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

            // Correctly pass the array of emails and the video link
            Mail::to($emails)->send(new SendCredentialAccessLink($emails, $link, $user->name, $user->agreement_video));

            return back()->with('success', 'User marked as deceased and secure link sent to close kin.');
        }

        return back()->with('success', 'User marked as deceased successfully.');
    }

    // Method to show feedback
    public function showFeedback()
    {
        $feedbacks = Feedback::all(); // Ensure you have a Feedback model and it's imported

        return view('admin.feedback.index', compact('feedbacks'));
    }

    // Method to show complaints
    public function showComplaints()
    {
        $complaints = Complaint::all();

        return view('admin.complaints.index', compact('complaints'));
    }

    // Method to show reply form
    public function showReplyForm(Complaint $complaint)
    {
        return view('admin.complaints.reply', compact('complaint'));
    }

    // Method to delete a complaint
    public function destroyComplaint(Complaint $complaint)
    {
        $complaint->delete();

        return redirect()->route('admin.complaints.index')->with('success', 'Complaint deleted successfully.');
    }

    // Method to reply to a complaint
    public function replyToComplaint(Request $request, Complaint $complaint)
    {
        $request->validate([
            'reply' => 'required|string|max:5000',
        ]);

        // Update the complaint with the reply
        $complaint->reply = $request->reply;
        $complaint->save();

        // Send the reply via email to the user
        Mail::to($complaint->email)->send(new ComplaintReplyMail($request->reply, $complaint->ticket_number));

        return redirect()->route('admin.complaints.index')->with('success', 'Reply sent successfully.');
    }

    // Method to view death certificates
    public function viewDeathCertificates()
    {
        $deathCertificates = DeathCertificate::where('verified', false)->get();
        return view('admin.deathCertificates', compact('deathCertificates'));
    }

    // Method to verify death certificates
    public function verifyDeathCertificate($id)
    {
        $deathCertificate = DeathCertificate::findOrFail($id);
        $deathCertificate->verified = true;
        $deathCertificate->save();

        // Notify close kin about verification
        Mail::to($deathCertificate->close_kin_email)->send(new DeathCertificateVerifiedMail($deathCertificate));

        return redirect()->route('admin.deathCertificates')->with('success', 'Death certificate verified successfully.');
    }

    public function dashboard()
    {
        $users = User::where('role', '<>', 'admin')->where('is_deceased', false)->get();
        $deceasedUsers = User::where('is_deceased', true)->get();
        $pendingDeathCertificatesCount = DeathCertificate::where('verified', false)->count();
        $recentActivities = AuditLog::latest()->take(3)->get(); // Fetch the latest 3 activities

        return view('admin.dashboard', compact('users', 'deceasedUsers', 'pendingDeathCertificatesCount', 'recentActivities'));
    }
}
