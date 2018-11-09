<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
   public function authenticate(){
       $credentials=request()->only('first_name','last_name','password');
       if(Auth::guard('admin')->attempt($credentials)){
           //$user=Auth::guard('admin')->user();
           //$data['user']=$user;
           return view('morgue.admin.admin_home');
       }else{
           return redirect('/');
       }
   }
   
   public function logout(){
       Auth::logout();
       return view('morgue.login.login');
   }
}
