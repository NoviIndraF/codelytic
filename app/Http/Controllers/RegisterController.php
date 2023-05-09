<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        return view('authentication.register.index',[
            "title" => "Register",
            'active' => 'register',
        ]);
    }

    public function store(Request $request){
        $request->request->add([
            'status' => 'teacher',
            'showing_status' => '0',
        ]);
        
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:50', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            'status' => 'min:3',
            'showing_status' =>'required'
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        
        User::create($validatedData);

        $request->session()->flash('success', 'Registration successfull!! Please Login first');
        return redirect('/login');
    }
}
