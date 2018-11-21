<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AdminController extends Controller
{
   public function authenticate(){
       request()->validate([
           'first_name'=>'required',
           'last_name'=>'required',
           'password'=>'required'
       ]);
       /*
       $rules=[
           'first_name'=>'required',
           'last_name'=>'required',
           'password'=>'required'
       ];
        * 
        */
       $credentials=request()->only('first_name','last_name','password');
       
       //$validator=Validator::make($credentials,$rules);
       
       if(Auth::guard('admin')->attempt($credentials)){
           $user=Auth::guard('admin')->user();
           //$data['user']=$user;
           //return $user;
           session(['guard'=>'admin']);
           return view('morgue.admin.admin_home');
           /*
           if(Auth::guard('admin')->check()){
               return 'User is logged in';
           }else{
               return 'User not logged in';
           }
            * 
            */
       }else{
           $auth_error="Username or password not found";
           $data['auth_error']=$auth_error;
           return view('morgue.login.login',$data);
       }
   }
   
   public function logout(){
       Auth::guard('admin')->logout();
       session()->forget('guard');
       return view('morgue.login.login');
   }
}
