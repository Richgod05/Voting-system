<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function resetPassword()
    {
        return view('resetpassword');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('students')
                         ->sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request, $token)
    {
        return view('password.reset', [
            'token' => $token,
            'email' => $request->input('email'),
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email',
            'password'              => 'required|confirmed|min:8',
            'token'                 => 'required',
        ]);

        $status = Password::broker('students')
                         ->reset(
                            $request->only('email','password','password_confirmation','token'),
                            function ($students, $password) {
                                $students->password = bcrypt($password);
                                $students->save();
                            }
                         );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success','Password reset successful.')
            : back()->withErrors(['email'=>[__($status)]]);
    }
}