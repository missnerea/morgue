<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class ReleasedDeceasedResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id=request()->get('id');
        $current_deceased=\App\Deceased::find($id);
        $data['deceased']=$current_deceased;
        return view('morgue.deceased.checkout_deceased',$data);
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
            'cause_of_death'=>'required',
            'date_in'=>'required',
            'date_out'=>'required',
            'charges'=>'required'
        ];
        /*
        $messages=[
            'dob.required'=>'The Date of Birth field is required',
            'ID_number.required'=>'The ID number field is required'
        ];
        */
        Validator::make($request->all(),$rules)->validate();
        
        $data=$request->all();
        
        $date_in=new \DateTime($data['date_in']);
        $date_out=new \DateTime($data['date_out']);
        $days_diff=$date_out->diff($date_in)->d;
        $charges=$days_diff * 500;
        
        $deceased=\App\Deceased::find($data['id']);
        $deceased->date_out=$data['date_out'];
        $deceased->charges=$charges;
        $deceased->save();
        
        if(session('guard')=='admin'){
            return redirect()->route('admin_re.index');
        }else if(session('guard')=='undertaker'){
            return redirect()->route('undertaker_re.index');
        }
  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
