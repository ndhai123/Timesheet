<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function checkLogin(Request $request){
        $check = $request -> only('email', 'password');
        if(Auth::attempt($check) && Auth::user()->role == 1){
            return redirect('/home');
        }else{
            return redirect('/') ->withErrors('Please check email or password');;
        }
    }
}
