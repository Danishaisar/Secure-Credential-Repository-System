<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CredentialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $credentials = Auth::user()->credentials()->get();
        return view('credentials.index', compact('credentials'));
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
        Auth::user()->credentials()->create($validatedData);

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
        $this->authorize('update', $credential);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('credentials')->ignore($credential->id)->where('user_id', Auth::id())
            ],
            'password' => 'nullable|string|min:6',
            'description' => 'required|string',
        ]);

        $credential->name = $request->name;
        $credential->username = $request->username;
        $credential->description = $request->description;

        if ($request->filled('password')) {
            // No need to manually encrypt the password here, it's handled by the model
            $credential->password = $request->password;
        }

        $credential->save();

        return redirect()->route('credentials.index')->with('success', 'Credential updated successfully.');
    }

    public function destroy(Credential $credential)
    {
        $this->authorize('delete', $credential);
        $credential->delete();
        return back()->with('success', 'Credential deleted successfully.');
    }
}
