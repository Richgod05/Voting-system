<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    // Show registration page
    public function index()
    {
        // Redirect if already logged in as student
        if (Auth::guard('students')->check()) {
            return redirect()->route('vote.show');
        }

        return view('register');
    }

    // Show login page
    public function login()
    {
        if (Auth::guard('students')->check()) {
            return redirect()->route('vote.show');
        }

        return view('login');
    }

    // Process registration
    public function processRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:students,email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->numbers()->mixedCase()
            ]
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        $student = new Student();
        $student->email = $request->input('email');
        $student->password = Hash::make($request->input('password'));
        $student->save();

        // Log in after registration
        Auth::guard('students')->login($student);

        return redirect()->route('vote.show')->with('success', 'You have login succesfully!');
    }

    // Authenticate student user
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::guard('students')->attempt($credentials)) {
            return redirect()->route('vote.show');
        }

        return redirect()->route('login')->with('error', 'Either password or Email is incorrect!');
    }

    // Logout student
    public function logout()
    {
        Auth::guard('students')->logout();
        return redirect()->route('login')->with('success', 'You have logout succesfully!');
    }
}