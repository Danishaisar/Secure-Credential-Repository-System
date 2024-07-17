<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::where('user_id', Auth::id())->get();
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:wasiat,hibah,waqf',
            'document' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $path = $request->file('document')->store('documents', 'public');

        Document::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'document_path' => $path,
        ]);

        return redirect()->route('documents.index')->with('success', 'Document uploaded successfully.');
    }

    public function destroy(Document $document)
    {
        if ($document->user_id !== Auth::id()) {
            abort(403);
        }

        Storage::disk('public')->delete($document->document_path);
        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document deleted successfully.');
    }
}

