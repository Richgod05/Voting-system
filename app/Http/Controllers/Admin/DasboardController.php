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

    public function showPresident()
    {
    $candidates = Candidate::where('position', 'President')->get();
    return view('Admin.president', compact('candidates'));
    }


    public function showParliament()
    {
    $candidates = Candidate::where('position', 'Member of Parliament (MPs)')->get();
    return view('Admin.parliament', compact('candidates'));
    }

        public function showChairperson()
    {
    $candidates = Candidate::where('position', 'Chairperson Of Crs')->get();
    return view('Admin.chairperson', compact('candidates'));
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
    $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('images'), $imageName);
    $request->merge(['image' => $imageName]);

    } 
    else {
    $request->merge(['image' => 'profile.png']);
    }

    Candidate::create($data);

    return redirect()->route('admin.candidate')->with('success', 'Candidate added successfully!');
}

public function update(Request $request, $id)
{
    $candidate = Candidate::findOrFail($id);

    if ($request->hasFile('image')) {
        // Delete old image if it's not the default
        if ($candidate->image && $candidate->image !== 'profile.png') {
            $oldImagePath = public_path('images/' . $candidate->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Save new image
        $file = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $imageName);
        $request->merge(['image' => $imageName]);
    }

    $candidate->update($request->all());
    return redirect()->back()->with('success', 'Candidate updated successfully.');
}

}
