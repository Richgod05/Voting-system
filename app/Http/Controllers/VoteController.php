<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Candidate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function index()
    {
        return view('vote');
    }

public function show()
{
    $user = Auth::user(); // Get the authenticated user
    $studentId = $user->id; // Or however you're identifying the user
    $hasVoted = Vote::where('user_id', $studentId)->exists();
    $candidates = Candidate::all();

    return view('vote', compact('candidates', 'hasVoted'));
}


    public function cast(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        $user = Auth::user(); // Uses default 'web' guard

        if (!$user || $user->role !== 'student') {
            return redirect()->route('vote.show')->with('error', 'Only students can vote.');
        }

        $studentId = $user->id;

        // Check if the student has already voted
        $existingVote = Vote::where('user_id', $studentId)->first();

        if ($existingVote) {
            return redirect()->route('vote.show')->with('error', 'You have already voted.');

            $user = Auth::user();
            $studentId = $user->id(); // or however you're identifying the user
            $hasVoted = Vote::where('user_id', $studentId)->exists();

            return view('vote.show', compact('hasVoted', 'candidates'));

        }
        
        

        // Record the vote
        Vote::create([
            'user_id' => $studentId,
            'candidate_id' => $request->input('candidate_id'),
        ]);

        return redirect()->route('vote.results')->with('success', 'Your vote has been recorded!');
    }
}