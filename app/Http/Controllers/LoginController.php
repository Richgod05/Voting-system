<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //this will show register page for users.
    public function index(){
        return view ('register');
    }

    //this will show login page for users.
    public function login(){
        return view ('login');
    }

    
    public function ProcessRegister(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'email'=>'required |email |unique:users',
            'password'=>'required | confirmed |min:8',
            'password_confirmation'=>'required',  
        ]);

        if ($validator->passes()){

            $student = new Student();
            $student->email = $request->input('email');
            $student->password = bcrypt($request->input('password')); // bcrypt returns a hashed string
            $student->save();

            return redirect()->route('vote.cast')->with('success','You have registered succesfully.');

        } else {
            return redirect()->route('register')
            ->withInput()
            ->withErrors($validator);
        }
    }

    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required |email',
            'password'=>'required'
        ]);

        if ($validator->passes()){

            if(Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')])){
                return redirect()->route('vote.cast');

            } else {
                return redirect()->route('login')->with('error','Hatuna Hii akaunti kwenye data zetu!');
            }

        } else {
            return redirect()->route('login')
            ->withInput()
            ->withErrors($validator);
        }
    }
}


