<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Gate;

use Validator;

class AdminResourceController extends Controller
{
    public function showPasswordChange($id){
        $user=\App\Admin::find($id);
        $view_data['user']=$user;
        return view('morgue.admin.admin_change_password',$view_data);
    }
    
    public function changePassword($id){
        $data=request()->all();
        $user=\App\Admin::find($id);
        $current_user=Auth::guard('admin')->user();
        
        if(Gate::forUser($current_user)->allows('super-admin')){
            
            $rules=[
                'new_password'=>'required|confirmed'
            ];
            
            Validator::make($data,$rules)->validate();
            
            $user->password=Hash::make($data['new_password']);
            $user->save();
            
            return view('morgue.admin.admin_home');
            
        }else{
        $rules=[
            'old_password'=>'required',
            'new_password'=>'required|confirmed'
        ];
        
        Validator::make($data,$rules)->validate();
        
        if(Hash::check($data['old_password'],$user->password)){
            $user->password=Hash::make($data['new_password']);
            $user->save();
            
            return view('morgue.admin.admin_home');
        }else{
            $error_message="Old password does not match";
            $view_data['error_message']=$error_message;
            $view_data['user']=$user;
            return view('morgue.admin.admin_change_password',$view_data);
        }
        }
    }
    
    public function returnAllRecords(){
        $records=\App\Admin::where('id','!=','1')->paginate(4);
        $data['records']=$records;
        return view('morgue.admin.admin_search',$data);
    }
    
    public function showDelete($id){
        $user=\App\Admin::find($id);
        $data['user']=$user;
       return view('morgue.admin.admin_delete',$data);
        //return $user;
    }
    
    public function showSearch(){
        return view('morgue.admin.admin_search');
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
            
            $records= \App\Admin::where($column_old,$operator_old,$value_old)->where('id','!=','1')->paginate(3);
            $data['records']=$records;
            return view('morgue.admin.admin_search',$data);
        } else{
        $request->session()->put('deceased_column',$column);
        $request->session()->put('deceased_operator',$operator);
        $request->session()->put('deceased_value',$value);
        $records= \App\Admin::where($column,$operator,$value)->where('id','!=','1')->paginate(3);
        $data['records']=$records;
        return view('morgue.admin.admin_search',$data);
    }
    }
    
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
        $data=$request->all();
        $data['minimum_date']=date('Y-m-d',strtotime('-18 years',strtotime(date('Y-m-d'))));
         $rules=[
            'first_name'=>'required|alpha|min:3',
            'last_name'=>'required|alpha|min:3',
            'gender'=>'required',
            'ID_number'=>'required|integer|max:99999999',
            'dob'=>'required|date|before_or_equal:minimum_date',
            'password'=>['required','confirmed',"min:5",'max:20']
        ];
        
        $messages=[
            'dob.required'=>'The Date of Birth field is required',
            'ID_number.required'=>'The ID number field is required',
            'dob.before_or_equal'=>'The Date of Birth must be at least 18 years ago',
            'ID_number.max'=>'Please enter a valid ID number',
            'password.min'=>'The password must contain at least 5 characters',
            'password.max'=>'The password must less than 20 characters',
        ];
        
        Validator::make($data,$rules,$messages)->validate();
        
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
        $data=$request->all();
        $data['minimum_date']=date('Y-m-d',strtotime('-18 years',strtotime(date('Y-m-d'))));
        $rules=[
            'first_name'=>'required|alpha',
            'last_name'=>'required|alpha',
            'gender'=>'required',
            'ID_number'=>'required|integer|max:99999999',
            'dob'=>'required|date|before_or_equal:minimum_date',
        ];
        
        $messages=[
            'dob.required'=>'The Date of Birth field is required',
            'ID_number.required'=>'The ID number field is required',
            'dob.before_or_equal'=>'The Date of Birth must be at least 18 years ago',
            'ID_number.max'=>'Please enter a valid ID number'
        ];
        
        Validator::make($data,$rules,$messages)->validate();
        
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
        $admin=\App\Admin::find($id);
        $current_user=Auth::guard('admin')->user();
        
        $admin->undertakers()->get()->each(function($record) use($current_user){
            $record->admin()->associate($current_user);
            $record->save();
        });
        
        $admin->deceased()->get()->each(function($record) use($current_user){
            $record->admin()->associate($current_user);
            $record->save();
        });
        
        \App\Admin::destroy($id);
        return redirect()->route('admin_re.index');
    }
}
