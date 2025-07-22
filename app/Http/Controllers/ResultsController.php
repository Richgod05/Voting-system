<?php

namespace App\Http\Controllers;
use App\Models\Vote;
use App\Models\Candidate;
use Illuminate\Http\Request;




class ResultsController extends Controller
{
    //for voting results.
    public function results()
    {
            $results = Candidate::withCount('votes')->get();
            return view('results', compact('results'));
    }
}
