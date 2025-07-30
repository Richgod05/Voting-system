<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    // Show reset request form
    public function resetPassword()
    {
        return view('password.resetpassword'); // Make sure this view exists
    }

    // Send reset link to user's email
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    // Show form to enter new password
    public function showResetForm(Request $request, $token = null)
    {
        return view('password.reset.form', [
            'token' => $token,
            'email' => $request->input('email'),
        ]);
    }

    // Process the password reset
    public function reset(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token'    => 'required',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password reset successful.')
            : back()->withErrors(['email' => [__($status)]]);
    }
}