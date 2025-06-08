<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function logout(){
        if(Auth::logout()){
            return redirect('/');
        }else{
            return redirect('/home');
        }
    }

    public function login(Request $request){
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/');
        }else{
            return view('auth.login', ['page'=>'Dashboard']);
        }
        
    }
}
