<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Candidate;
use App\Models\User;

class AdminController extends Controller
{
    // Show admin login form
    public function login()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.adminlogin');
    }

    // Authenticate admin credentials
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.adminlogin')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $admin = Auth::user();

            if ($admin->role !== 'admin') {
                Auth::logout();
                return redirect()->route('admin.adminlogin')->with('error', 'Access denied: Not an admin.');
            }

            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, admin!');
        }

        return redirect()->route('admin.adminlogin')->with('error', 'Invalid login credentials.');
    }

    // Admin dashboard
    public function dashboard()
    {
        $admin = Auth::user();

        if (!$admin || $admin->role !== 'admin') {
            return redirect()->route('admin.adminlogin')->with('error', 'Unauthorized access.');
        }

        $students = User::where('role', 'student')->with('vote')->get();
        $candidates = Candidate::withCount('votes')->get();

        return view('admin.dashboard', compact('students', 'candidates'));
    }

    // Logout admin
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.adminlogin')->with('success', 'You have logged out successfully!');
    }
}