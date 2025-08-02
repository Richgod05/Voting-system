<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    // Show registration page
    public function index()
    {
        // Redirect if already logged in
        if (Auth::check()) {
            return redirect()->route('vote.show');
        }

        return view('register');
    }

    // Show login page
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('vote.show');
        }

        return view('login');
    }

    // Process registration
    public function processRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255', // Laravel expects a name field
            'email' => 'required|email|unique:users,email',
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

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = 'student';
        $user->save();

        // Log in after registration
        Auth::login($user);

        return redirect()->route('vote.show')->with('success', 'You have logged in successfully!');
    }

    // Authenticate user
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

        if (Auth::attempt($credentials)) {
            return redirect()->route('vote.show');
        }

        return redirect()->route('login')->with('error', 'Either password or email is incorrect!');
    }

    // Logout user
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'You have logged out successfully!');
    }
}