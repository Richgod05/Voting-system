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
        return view('register');
    }

    // Show login page
    public function login()
    {
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

        return redirect()->route('vote.cast')->with('success', 'You have registered successfully.');
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

        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])) {
            return redirect()->route('vote.cast');
        } else

        return redirect()->route('login')->with('error', 'Hatuna hii akaunti kwenye data zetu!');
    }
}