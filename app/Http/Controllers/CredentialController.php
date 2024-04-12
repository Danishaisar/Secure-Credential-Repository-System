<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CredentialController extends Controller
{
    public function __construct()
    {
        // Apply authentication middleware to all actions except those that are explicitly allowed
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
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                // Assume each user's credential names must be unique
                Rule::unique('credentials')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                }),
            ],
            'password' => 'required|string|min:6',
            'description' => 'required|string',
        ]);

        Auth::user()->credentials()->create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'description' => $request->description,
        ]);

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
                // Ensure username is unique for the user excluding the current credential
                Rule::unique('credentials')->where(function ($query) use ($credential) {
                    return $query->where('user_id', Auth::id())->where('id', '!=', $credential->id);
                }),
            ],
            'password' => 'nullable|string|min:6',
            'description' => 'required|string',
        ]);

        $credential->fill([
            'name' => $request->name,
            'username' => $request->username,
            'description' => $request->description,
        ]);

        if ($request->filled('password')) {
            $credential->password = Hash::make($request->password);
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
