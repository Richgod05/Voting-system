<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vote;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
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

    public function login(){
        return view('admin.adminlogin');
    }

        public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required |email',
            'password'=>'required'
        ]);

        if ($validator->passes()){

            if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){

                if(Auth::guard('admin')->user()->role != "admin"){
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.adminlogin')->with('error','You are not Authorized to acess this page');
                }

                return redirect()->route('admin.dashboard');

            } else {
                return redirect()->route('admin.login')->with('error','Please register to user register page and get authenticated first');
            }

        } else {
            return redirect()->route('admin.adminlogin')
            ->withInput()
            ->withErrors($validator);
        }

}

}
