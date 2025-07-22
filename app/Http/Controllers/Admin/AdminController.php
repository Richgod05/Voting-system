<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Candidate;
use App\Models\Student;


class AdminController extends Controller
{
    //for admin dashboard
    public function dashboard()
    {
        $students = Student::with('vote')->get();
        $candidates = Candidate::withCount('votes')->get();

        return view('admin.dashboard', compact('students', 'candidates'));
    }
}
