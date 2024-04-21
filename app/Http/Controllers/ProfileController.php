<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param Request $request
     * @return View
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $familyInfo = $user->familyInfo()->firstOrCreate([]); // Ensure the user has a family info entry

        return view('profile.edit', [
            'user' => $user,
            'familyInfo' => $familyInfo,
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param ProfileUpdateRequest $request
     * @return RedirectResponse
     */
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

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Display the form to manage family information.
     *
     * @return View
     */
    public function manageFamily()
    {
        $user = Auth::user();
        $familyInfo = $user->familyInfo()->firstOrCreate([]);

        return view('user.family.manage', [
            'user' => $user,
            'familyInfo' => $familyInfo
        ]);
    }

    /**
     * Update the user's family information.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateFamilyInfo(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $input = $request->validate([
            'kin_email_1' => 'nullable|email|max:255',
            'relation_1' => 'nullable|string|max:255', // Validation for relation_1
            'kin_email_2' => 'nullable|email|max:255',
            'relation_2' => 'nullable|string|max:255', // Validation for relation_2
            'kin_email_3' => 'nullable|email|max:255',
            'relation_3' => 'nullable|string|max:255', // Validation for relation_3
            'additional_info' => 'nullable|string|max:1000'
        ]);

        // Update or create family info record
        $user->familyInfo()->updateOrCreate([], $input);

        return redirect()->route('user.family.manage')->with('success', 'Family information updated successfully.');
    }

    /**
     * Delete the user's account.
     *
     * @param Request $request
     * @return RedirectResponse
     */
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

        return Redirect::to('/');
    }
}
