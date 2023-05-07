<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('login.index',[
            "title" => "Login",
            'active' => 'login',
        ]);
    }

    public function authenticate(Request $request){
        return redirect()->intended('/dashboard');
    }

    public function logout(){
        return redirect('/');
    }
    
}
