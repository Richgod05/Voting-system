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
        return view('admin.adminlogin');
    }

    //this methoe will authenticate admin.
    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required |email',
            'password'=>'required'
        ]);

        if ($validator->passes()){

            if(Auth::guard('admins')->attempt(['email'=>$request->email,'password'=>$request->password])){

                if(Auth::guard('admins')->user()->role != "admin"){
                    Auth::guard('admins')->logout();
                    return redirect()->route('admin.adminlogin')->with('error','You are not Authorized to acess this page');
                }

                return redirect()->route('admin.dashboard');

            } else {
                return redirect()->route('admin.adminlogin')->with('error','You are not authorized to access this page');
            }

        } else {
            return redirect()->route('admin.adminlogin')
            ->withInput()
            ->withErrors($validator);
        }
    }

    // Admin dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    //results controller
        public function results()
    {
            $results = Candidate::withCount('votes')->get();
            return view('results', compact('results'));
    }


    // Logout admin
    public function logoutAdmin()
    {
        Auth::logout();
        return redirect()->route('admin.adminlogin')->with('success', 'You have logged out successfully!');
    }
}