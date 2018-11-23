<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class DeceasedResourceController extends Controller
{
    public function returnAllRecords(){
        $records=\App\Deceased::where('date_out','=',null)->paginate(4);
        $data['records']=$records;
        return view('morgue.deceased.current_deceased_view',$data);
    }
    
    public function redirectUser($admin_route,$undertaker_route){
        $current_user=Auth::guard('admin')->user();
        $route_name=$admin_route;
        if($current_user==null){
            $current_user=Auth::guard('undertaker')->user();
            $route_name=$undertaker_route;
        }
        
        return redirect()->route($route_name);
    }
    
    public function showDelete($id){
        $user=\App\Deceased::find($id);
        $data['user']=$user;
        return view('morgue.deceased.current_deceased_delete',$data);
    }
    
    public function showSearch(){
        return view('morgue.deceased.current_deceased_view');
    }
    
    public function searchSpecific(Request $request){
        $column=request()->get('column');
        $operator=request()->get('operator');
        $value=request()->get('value');
        if(/*$column==null and $operator==null and $value==null*/$request->isMethod('get')){
            //return 'search parameters are null';
            
            $column_old=session('deceased_column');
            $operator_old=session('deceased_operator');
            $value_old=session('deceased_value');
            
            $records= \App\Deceased::where($column_old,$operator_old,$value_old)->where('date_out','=',null)->paginate(6);
            $data['records']=$records;
            return view('morgue.deceased.current_deceased_view',$data);
        } else{
        $request->session()->put('deceased_column',$column);
        $request->session()->put('deceased_operator',$operator);
        $request->session()->put('deceased_value',$value);
        $records= \App\Deceased::where($column,$operator,$value)->where('date_out','=',null)->paginate(6);
        $data['records']=$records;
        return view('morgue.deceased.current_deceased_view',$data);
        }
    }
    
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
        $current_user=Auth::guard('admin')->user();
        $role='admin';
        if($current_user==null){
            $current_user=Auth::guard('undertaker')->user();
            $role='undertaker';
        }
        $data['current_user']=$current_user;
        $data['role']=$role;
        return view('morgue.deceased.current_deceased_registration',$data);
        //return $current_user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $data['current_date']=date('Y-m-d');
        $rules=[
            'first_name'=>'required|alpha',
            'last_name'=>'required|alpha',
            'gender'=>'required',
            'cause_of_death'=>'required',
            'date_in'=>'required|date|before_or_equal:current_date'
        ];
        
        $messages=[
            'date_in.required'=>'The Date In field is required'
        ];
        
        Validator::make($data,$rules,$messages)->validate();
        
        $deceased= new \App\Deceased;
        $deceased->first_name=$data['first_name'];
        $deceased->last_name=$data['last_name'];
        $deceased->gender=$data['gender'];
        $deceased->cause_of_death=$data['cause_of_death'];
        $deceased->date_in=$data['date_in'];
        
        $current_user_role=$request->get('creator_role');
        if($current_user_role=='admin'){
            $current_user=Auth::guard('admin')->user();
            $deceased->admin()->associate($current_user);
            $route_name='admin_re.index';
        }else if($current_user_role=='undertaker'){
            $current_user=Auth::guard('undertaker')->user();
            $deceased->undertaker()->associate($current_user);
            $route_name='undertaker_re.index';
        }
        
        $deceased->save();
        return redirect()->route($route_name);
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
        $deceased=\App\Deceased::find($id);
        $data['deceased']=$deceased;
        return view('morgue.deceased.current_deceased_update',$data);
        
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
        $data=$request->all();
        $data['current_date']=date('Y-m-d');
        $rules=[
            'first_name'=>'required|alpha',
            'last_name'=>'required|alpha',
            'gender'=>'required',
            'cause_of_death'=>'required',
            'date_in'=>'required|date|before_or_equal:current_date'
        ];
        
        $messages=[
            'date_in.required'=>'The Date In field is required'
        ];
        
        Validator::make($data,$rules,$messages)->validate();
        
        $user= \App\Deceased::find($id);
        $user->first_name=$data['first_name'];
        $user->last_name=$data['last_name'];
        $user->gender=$data['gender'];
        $user->cause_of_death=$data['cause_of_death'];
        $user->date_in=$data['date_in'];
        $user->save();
        
        $current_user=Auth::guard('admin')->user();
        $route_name='admin_re.index';
        if($current_user==null){
            $current_user=Auth::guard('undertaker')->user();
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
        \App\Deceased::destroy($id);
        return $this->redirectUser('admin_re.index','undertaker_re.index');
    }
}
