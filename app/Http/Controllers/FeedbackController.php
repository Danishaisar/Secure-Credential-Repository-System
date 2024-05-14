<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback; // Ensure you have the Feedback model imported
use Illuminate\Support\Facades\Auth; // Import Auth if you want to use it to get the user ID

class FeedbackController extends Controller
{
    /**
     * Store a new feedback entry in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'feedback' => 'required|string|max:1000', // Feedback must be a string and not longer than 1000 characters
        ]);
    
        $feedback = new Feedback;
        $feedback->feedback = $request->feedback;
        $feedback->user_id = Auth::id(); // Assign the user ID from the authenticated user
        $feedback->save();
    
        // Redirect back with a success message
        return back()->with('success', 'Thank you for your feedback! It has been sent successfully.');
    }
    
}
