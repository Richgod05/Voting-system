<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\User;
use Illuminate\Http\Request;

class DasboardController extends Controller
{
    //this will show candidates page.
    public function index()
    {
    $candidates = Candidate::all(); 
    return view('Admin.candidates', compact('candidates'));
    }

    public function showQualified()
    {
    $candidates = Candidate::where('status', 'Qualified')->get();
    return view('Admin.qualifiedcandidates', compact('candidates'));
    }

    public function user()
    {
        $adminUsers = User::where('role', 'admin')->get();

        return view('admin.user', compact('adminUsers'));
    }

    public function create()
{
    return view('Admin.addcandidate');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'level' => 'required|string',
        'programme' => 'required|string',
        'manifesto' => 'required|string',
        'status' => 'required|in:Qualified,Disqualified',
        'image' => 'nullable|image|max:2048',
    ]);

    $data = $request->only(['name', 'level', 'programme', 'manifesto', 'candidate_id', 'status']);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension(); 
        $file->storeAs('public/candidates', $filename); 
        $data['image'] = 'candidates/' . $filename; 
    }

    Candidate::create($data);

    return redirect()->route('admin.candidate')->with('success', 'Candidate added successfully!');
}


}
