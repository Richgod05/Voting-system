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
        'name' => 'required|string|min:1',
        'level' => 'required|string|min:1',
        'programme' => 'required|string|min:1',
        'manifesto' => 'required|string|min:1',
        'position' => 'required|in:President,Member of Parliament (MPs),Chairperson Of Crs',
        'status' => 'required|in:Qualified,Disqualified',
        'image' => 'nullable|image|max:2048',
    ]);

    $data = $request->only(['name', 'level', 'programme', 'manifesto', 'status', 'image', 'position']);

    // Apply fallback defaults if fields are empty or whitespace
    $data['level'] = trim($data['level']) !== '' ? $data['level'] : 'Unknown';
    $data['programme'] = trim($data['programme']) !== '' ? $data['programme'] : 'Undeclared';
    $data['manifesto'] = trim($data['manifesto']) !== '' ? $data['manifesto'] : 'No manifesto provided.';
    $data['status'] = $data['status'] ?? 'Disqualified';

    // Handle image upload or fallback to default
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension(); 
        $file->storeAs('public/candidates', $filename); 
        $data['image'] = 'candidates/' . $filename; 
    } else {
        $data['image'] = 'profile.png'; // Make sure this file exists in your public storage
    }

    Candidate::create($data);

    return redirect()->route('admin.candidate')->with('success', 'Candidate added successfully!');
}

}
