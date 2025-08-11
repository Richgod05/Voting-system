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


}
