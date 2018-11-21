<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UndertakerController extends Controller
{
    public function authenticate(){
       $credentials=request()->only('first_name','last_name','password');
       if(Auth::guard('undertaker')->attempt($credentials)){
           session(['guard'=>'undertaker']);
           return view('morgue.undertaker.undertaker_home');
       }else{
           $auth_error="Username or password not found";
           $data['auth_error']=$auth_error;
           return view('morgue.login.login',$data);
       }
   }
   
   public function logout(){
       Auth::guard('undertaker')->logout();
       session()->forget('guard');
       return view('morgue.login.login');
   }
}
