<?php

namespace App\Http\Controllers;
use App\Models\Vote;
use App\Models\Candidate;
use Illuminate\Http\Request;



class VoteController extends Controller
{

    public function index()
    {
        return view('vote');
    }

   

    public function show()
    {
            // Fetch all candidates from the database
            $candidates = Candidate::all();
            return view('vote', compact('candidates'));
    }

    public function cast(Request $request)
    {
            // Validate the incoming request
            $request->validate([
                'candidate_id' => 'required|exists:candidates,id',
            ]);

            $user = \Illuminate\Support\Facades\Auth::user();
            if (!$user || !isset($user->id)) {
                return redirect()->route('vote.show')->with('error', 'User not authenticated or missing ID.');
            }
            $studentId = $user->id;

            // Check if the student has already voted
            $existingVote = Vote::where('student_id', $studentId)->first();

            if ($existingVote) {
            return redirect()->route('vote.show')->with('error', 'You have already voted.');
            }

            // Record the vote
            Vote::create([
                'student_id' => $studentId,
                'candidate_id' => $request->input('candidate_id'),
            ]);

            return redirect()->route('vote.show')->with('success', 'Your vote has been recorded!');
    }
}
