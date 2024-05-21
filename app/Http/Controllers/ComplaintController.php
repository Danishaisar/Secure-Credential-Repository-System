<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Mail\ComplaintReplyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the complaints.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaints = Complaint::all();
        return view('admin.complaints.index', compact('complaints'));
    }

    /**
     * Show the form for replying to the specified complaint.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function replyForm(Complaint $complaint)
    {
        return view('admin.complaints.reply', compact('complaint'));
    }

    /**
     * Reply to the specified complaint.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function reply(Request $request, Complaint $complaint)
    {
        $request->validate([
            'reply' => 'required|string|max:5000',
        ]);

        $complaint->update([
            'reply' => $request->reply,
        ]);

        // Send reply email to the user
        Mail::to($complaint->email)->send(new ComplaintReplyMail($request->reply, $complaint->ticket_number));

        return redirect()->route('admin.complaints.index')->with('success', 'Reply sent successfully.');
    }
}
