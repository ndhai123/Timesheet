<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function login(){
        return view('login');
    }

    public function checkLogin(Request $request){
        $check = $request -> only('email', 'password');
        if(Auth::attempt($check)){
            return redirect('/home');
        }else{
            return redirect('/login') ->withErrors('Please check email or password');;
        }
    }
}
