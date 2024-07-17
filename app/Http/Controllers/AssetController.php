<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::where('user_id', Auth::id())->get();
        return view('assets.index', compact('assets'));
    }

    public function create()
    {
        return view('assets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('document')->store('assets', 'public');

        Asset::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'document_path' => $path,
        ]);

        return redirect()->route('assets.index')->with('success', 'Asset added successfully.');
    }

    public function destroy(Asset $asset)
    {
        if ($asset->user_id !== Auth::id()) {
            abort(403);
        }

        Storage::disk('public')->delete($asset->document_path);
        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully.');
    }
}

