<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeathCertificate;

class DeathCertificateController extends Controller
{
    // Show the form for submitting a death certificate
    public function create()
    {
        return view('kin.deathCertificate');
    }

    // Store the submitted death certificate
    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'close_kin_email' => 'required|email|max:255',
            'death_certificate' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $path = $request->file('death_certificate')->store('death_certificates', 'public');

        DeathCertificate::create([
            'user_name' => $request->user_name,
            'close_kin_email' => $request->close_kin_email,
            'path' => $path,
        ]);

        return redirect()->back()->with('success', 'Death certificate submitted successfully.');
    }
}
