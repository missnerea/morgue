<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Validator;

class AdminResourceController extends Controller
{
    
    public function __construct(){
        //$this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('morgue.admin.admin_home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('morgue.admin.admin_registration');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        
        $data=$request->all();
        $admin=\App\Admin::create([
            'first_name'=>$data['first_name'],
            'last_name'=>$data['last_name'],
            'gender'=>$data['gender'],
            'id_number'=>$data['ID_number'],
            'date_of_birth'=>$data['dob'],
            'password' => Hash::make($data['password'])
        ]);
        
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
        $user=\App\Admin::find($id);
        $data['user']=$user;
        return view('morgue.admin.admin_personal',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=\App\Admin::find($id);
        $data['user']=$user;
        return view('morgue.admin.admin_update_personal',$data);
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
        $user=\App\Admin::find($id);
        $user->first_name=$data['first_name'];
        $user->last_name=$data['last_name'];
        $user->gender=$data['gender'];
        $user->id_number=$data['ID_number'];
        $user->date_of_birth=$data['dob'];
        $user->save();
        
        return redirect()->route('admin_re.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
