<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Mail\KinRegistrationNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Helpers\AuditLogHelper; // Import the AuditLogHelper

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $user = $request->user();
        $familyInfo = $user->familyInfo()->firstOrCreate([]); // Ensure the user has a family info entry

        return view('profile.edit', [
            'user' => $user,
            'familyInfo' => $familyInfo,
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;  // Reset email verification if email was changed
        }

        $user->save();

        // Also save the family info
        $user->familyInfo()->updateOrCreate([], $request->only([
            'kin_email_1',
            'kin_email_2',
            'kin_email_3',
            'additional_info'
        ]));

        // Log the action
        AuditLogHelper::log('Updated profile', "Updated profile for user: {$user->email}");

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function manageFamily()
    {
        $user = Auth::user();
        $familyInfo = $user->familyInfo()->firstOrCreate([]);

        return view('user.family.manage', [
            'user' => $user,
            'familyInfo' => $familyInfo
        ]);
    }

    public function updateFamilyInfo(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $input = $request->validate([
            'kin_email_1' => 'nullable|email|max:255',
            'relation_1' => 'nullable|string|max:255',
            'kin_email_2' => 'nullable|email|max:255',
            'relation_2' => 'nullable|string|max:255',
            'kin_email_3' => 'nullable|email|max:255',
            'relation_3' => 'nullable|string|max:255',
            'additional_info' => 'nullable|string|max:1000'
        ]);
    
        // Update or create family info record
        $familyInfo = $user->familyInfo()->updateOrCreate([], $input);
    
        // Send notification emails to each kin
        $this->notifyKins($familyInfo);

        // Log the action
        AuditLogHelper::log('Updated family info', "Updated family info for user: {$user->email}");
    
        return redirect()->route('user.family.manage')->with('success', 'Family information updated successfully.');
    }
    
    private function notifyKins($familyInfo)
    {
        $kins = [
            ['email' => $familyInfo->kin_email_1, 'relation' => $familyInfo->relation_1],
            ['email' => $familyInfo->kin_email_2, 'relation' => $familyInfo->relation_2],
            ['email' => $familyInfo->kin_email_3, 'relation' => $familyInfo->relation_3]
        ];
    
        foreach ($kins as $kin) {
            if (!empty($kin['email'])) {
                Mail::to($kin['email'])->send(new KinRegistrationNotification($kin['email'], $kin['relation']));
            }
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        if ($user->delete()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        // Log the action
        AuditLogHelper::log('Deleted user', "Deleted user with email: {$user->email}");

        return Redirect::to('/');
    }
}
