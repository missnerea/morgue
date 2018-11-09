<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UndertakerController extends Controller
{
    public function authenticate(){
       $credentials=request()->only('first_name','last_name','password');
       if(Auth::guard('undertaker')->attempt($credentials)){
           return view('morgue.undertaker.undertaker_home');
       }else{
           return view('morgue.login.login');
       }
   }
   
   public function logout(){
       Auth::logout();
       return view('morgue.login.login');
   }
}
