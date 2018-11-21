<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class UndertakerResourceController extends Controller
{
    public function showDelete($id){
        $user=\App\Undertaker::find($id);
        $data['user']=$user;
        return view('morgue.admin.undertaker_delete',$data);
         
    }
    
    public function showSearch(){
        return view('morgue.admin.undertaker_search');
    }
    
    public function searchSpecific(Request $request){
        $column=request()->get('column');
        $operator=request()->get('operator');
        $value=request()->get('value');
        if($column==null and $operator==null and $value==null){
            //return 'search parameters are null';
            
            $column_old=session('undertaker_column');
            $operator_old=session('undertaker_operator');
            $value_old=session('undertaker_value');
            
            $records= \App\Undertaker::where($column_old,$operator_old,$value_old)->paginate(3);
            $data['records']=$records;
            return view('morgue.admin.undertaker_search',$data);
        } else{
        $request->session()->put('undertaker_column',$column);
        $request->session()->put('undertaker_operator',$operator);
        $request->session()->put('undertaker_value',$value);
        $records= \App\Undertaker::where($column,$operator,$value)->paginate(3);
       // $records->withPath('search');
        $data['records']=$records;
        return view('morgue.admin.undertaker_search',$data);
        }
    }
    
    public function returnAllRecords(){
        
    }
    
    public function __construct(){
        //$this->middleware('auth:undertaker,admin');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('morgue.undertaker.undertaker_home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('morgue.admin.undertaker_registration');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $request->validate([
            'first_name'=>'required|alpha',
            'last_name'=>'required|alpha',
            'gender'=>'required',
            'ID_number'=>'required|integer',
            'dob'=>'required',
            'password'=>'required|confirmed'
        ]);
        */
        
        $rules=[
            'first_name'=>'required|alpha',
            'last_name'=>'required|alpha',
            'gender'=>'required',
            'ID_number'=>'required|integer',
            'dob'=>'required',
            'password'=>'required|confirmed'
        ];
        
        $messages=[
            'dob.required'=>'The Date of Birth field is required',
            'ID_number.required'=>'The ID number field is required'
        ];
        
        Validator::make($request->all(),$rules,$messages)->validate();
        
        $current_admin=Auth::guard('admin')->user();
        
        $data=$request->all();
        $undertaker=new \App\Undertaker;
        $undertaker->first_name=$data['first_name'];
        $undertaker->last_name=$data['last_name'];
        $undertaker->gender=$data['gender'];
        $undertaker->id_number=$data['ID_number'];
        $undertaker->date_of_birth=$data['dob'];
        $undertaker->password=Hash::make($data['password']);
        $undertaker->admin()->associate($current_admin);
        $undertaker->save();
        
        return redirect()->route('admin_re.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=\App\Undertaker::find($id);
        $data['user']=$user;
        return view('morgue.undertaker.undertaker_personal',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=\App\Undertaker::find($id);
        $data['user']=$user;
        return view('morgue.undertaker.undertaker_update',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $rules=[
            'first_name'=>'required|alpha',
            'last_name'=>'required|alpha',
            'gender'=>'required',
            'ID_number'=>'required|integer',
            'dob'=>'required'
        ];
        
        $messages=[
            'dob.required'=>'The Date of Birth field is required',
            'ID_number.required'=>'The ID number field is required'
        ];
        
        Validator::make($request->all(),$rules,$messages)->validate();
        
        $data=$request->all();
        $user=\App\Undertaker::find($id);
        $user->first_name=$data['first_name'];
        $user->last_name=$data['last_name'];
        $user->gender=$data['gender'];
        $user->id_number=$data['ID_number'];
        $user->date_of_birth=$data['dob'];
        $user->save();
        
        if(session('guard')=='admin'){
            $route_name='admin_re.index';
        }else{
            $route_name='undertaker_re.index';
        }
        return redirect()->route($route_name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $undertaker=\App\Undertaker::find($id);
        $deceased=$undertaker->deceased()->get();
        $deceased->each(function($record){
            $current_user=Auth::guard('admin')->user();
            $record->undertaker()->dissociate();
            $record->admin()->associate($current_user);
            $record->save();
        });
        \App\Undertaker::destroy($id);
        return redirect()->route('admin_re.index');
    }
}
