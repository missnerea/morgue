<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class ReleasedDeceasedResourceController extends Controller
{
    public function showDelete($id){
        $user=\App\Deceased::find($id);
        $data['user']=$user;
        return view('morgue.deceased.released_deceased_delete',$data);
    }
    
    public function showSearch(){
        return view('morgue.deceased.released_deceased_search');
    }
    
    public function searchSpecific(Request $request){
        $column=request()->get('column');
        $operator=request()->get('operator');
        $value=request()->get('value');
        if(/*$column==null and $operator==null and $value==null*/$request->isMethod('get')){
            //return 'search parameters are null';
            
            $column_old=session('r_deceased_column');
            $operator_old=session('r_deceased_operator');
            $value_old=session('r_deceased_value');
            
            $records= \App\Deceased::where($column_old,$operator_old,$value_old)->where('date_out','!=',null)->paginate(6);
            $data['records']=$records;
            return view('morgue.deceased.current_deceased_view',$data);
        } else{
        $request->session()->put('r_deceased_column',$column);
        $request->session()->put('r_deceased_operator',$operator);
        $request->session()->put('r_deceased_value',$value);
        $records= \App\Deceased::where($column,$operator,$value)->where('date_out','!=',null)->paginate(6);
        $data['records']=$records;
        return view('morgue.deceased.released_deceased_search',$data);
        }
    }
    
    public function __construct() {
        //$this->middleware(auth::session('guard'));
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
        $deceased=\App\Deceased::find($id);
        $data['deceased']=$deceased;
        return view('morgue.deceased.released_deceased_update',$data);
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
            'cause_of_death'=>'required',
            'date_in'=>'required',
            'date_out'=>'required',
            'charges'=>'required|numeric|integer'
        ];
        
        
        Validator::make($request->all(),$rules)->validate();
        
        $data=$request->all();
        $user= \App\Deceased::find($id);
        $user->first_name=$data['first_name'];
        $user->last_name=$data['last_name'];
        $user->gender=$data['gender'];
        $user->cause_of_death=$data['cause_of_death'];
        $user->date_in=$data['date_in'];
        $user->date_out=$data['date_out'];
        $user->charges=$data['charges'];
        $user->save();
        
        if(session('guard')=='admin'){
            return redirect()->route('admin_re.index');
        }else if(session('guard')=='undertaker'){
            return redirect()->route('undertaker_re.index');
        }
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
        if(session('guard')=='admin'){
            return redirect()->route('admin_re.index');
        }else if(session('guard')=='undertaker'){
            return redirect()->route('undertaker_re.index');
        }
        
    }
}
