<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
// use Session;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function custom_login(Request $request)
    {
        $request->validate([
            'email'     =>  'required',
            'password'  =>  'required'
        ]);

        $credential = $request->only('email', 'password');

        // dd(th::attempt($credential));
        if(Auth::attempt($credential))
        {
            if( Auth::user()->user_status =="Enable")
            {
            return redirect()->intended('information')->withSuccess('Login');
            }else{
                Session::flush();
                return redirect('/')->with('error', 'You are Disabled by Admin');
            }
        }
        // $user = User::where('email',$request->email)->where('user_status',"Disable")->first();

        // if($user){
        //     return redirect('/')->with('error', 'You are Disabled by Admin');
        // }


        return redirect('/')->with('error', 'Login Details are not valid');
        // }
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function custom_registration(Request $request)
    {
        $request->validate([
            'name'      =>  'required',
            'email'     =>  'required|email|unique:users',
            'password'  =>  'required|min:6',

        ]);

        $data = $request->all();

        User::create([
            'name'      =>  $data['name'],
            'email'     =>  $data['email'],
            'password'  =>  Hash::make($data['password']),
            'type'      =>  'Admin'

        ]);

        return redirect('registration')->with('success', 'Registration Complete');
    }

    public function dashboard()
    {
        if(Auth::check())
        {
            return view('dashboard');
        }

        return redirect('/');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
