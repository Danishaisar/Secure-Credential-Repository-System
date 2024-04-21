<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FamilyInfo; // Make sure to import the FamilyInfo model

class SuperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('superadmin'); // Ensure this middleware is set up correctly.
    }

    public function index()
    {
        return view('superadmin.dashboard'); // Dashboard view for superadmins
    }

    /**
     * Display the family information managed by superadmins.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewFamilyInfo()
    {
        // Fetch all family information
        $familyInfos = FamilyInfo::all();

        // Return the superadmin family info view with the familyInfos data
        return view('superadmin.family.index', compact('familyInfos'));
    }

    /**
     * Verify a family info entry.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id The ID of the FamilyInfo to verify
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyFamilyInfo(Request $request, $id)
    {
        // Find the FamilyInfo by ID and set it as verified
        $familyInfo = FamilyInfo::findOrFail($id);
        $familyInfo->verified = true;
        $familyInfo->save();

        // Redirect back with a success message
        return redirect()->route('superadmin.family.index')->with('status', 'Family info verified successfully!');
    }
}
