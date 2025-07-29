<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    // For guests: show basic reset request form
    public function resetPassword()
    {
        return view('password.resetpassword'); // Use a clear view name
    }

    // For guests: send reset link to student's email
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('students')
            ->sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    // For guests: show reset form with token
    public function showResetForm(Request $request, $token = null)
    {
        return view('password.reset.form', [
            'token' => $token,
            'email' => $request->input('email'),
        ]);
    }

    // For authenticated students: handle direct reset request
    public function reset(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email',
            'password'              => 'required|confirmed|min:8',
            'token'                 => 'required',
        ]);

        $status = Password::broker('students')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($student, $password) {
                $student->password = bcrypt($password);
                $student->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password reset successful.')
            : back()->withErrors(['email' => [__($status)]]);
    }
}