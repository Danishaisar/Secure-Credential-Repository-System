<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function agreement()
    {
        return view('user.agreement');
    }

    public function storeAgreement(Request $request)
    {
        $request->validate([
            'agreement_video' => 'required|mimes:mp4|max:20480', // Adjust max size as needed
            'selected_kin' => 'required|array',
        ]);

        $user = Auth::user();

        if ($request->hasFile('agreement_video')) {
            $videoPath = $request->file('agreement_video')->store('agreement_videos', 'public');
            $user->agreement_video = $videoPath;
        }

        $user->selected_kin = $request->input('selected_kin');
        $user->save();

        return back()->with('success', 'Agreement video and close kin selection saved successfully.');
    }
}
