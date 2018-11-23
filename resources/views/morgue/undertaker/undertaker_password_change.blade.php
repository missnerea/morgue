@extends('morgue.base')

@section('title')
{{'Undertaker Password'}}
@stop

@section('content')

<div class='containter'>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ 'Change Undertaker Password' }}</div>
                    <div class="card-body">
                        <form method='post' id="form_login" action="{{route('undertaker_re.change_password',['id'=>$user->id])}}" >
            {{csrf_field()}}
            
            {{----ID----}}
            <div class="form-group row">
                <label for='old_password' class="col-md-4 col-form-label text-md-right">{{'ID'}}</label>
                <div class="col-md-6">
                    <input type='text' class="form-control" name='id' readonly value="{{$user->id}}"/>
                </div>
            </div>
            
            {{----First Name----}}
            <div class="form-group row">
                <label for='first_name' class="col-md-4 col-form-label text-md-right">{{'First Name'}}</label>
                <div class="col-md-6">
                    <input type='text' class="form-control" name='first_name' readonly value="{{$user->first_name}}"/>
                </div>
            </div>
            
            {{----Last Name----}}
            <div class="form-group row">
                <label for='last_name' class="col-md-4 col-form-label text-md-right">{{'Last Name'}}</label>
                <div class="col-md-6">
                    <input type='text' class="form-control" name='last_name' readonly value="{{$user->last_name}}"/>
                </div>
            </div>
            
            {{----Old Password  Only shown for undertaker----}}
            @if(session('guard')=='undertaker')
            <div class="form-group row">
                <label for='old_password' class="col-md-4 col-form-label text-md-right">{{'Old Password'}}</label>
                <div class="col-md-6">
                <input type='password' class="form-control" name='old_password' id='input_old_password'/>
                </div>
            </div>
            
            {!!$errors->first('old_password',
            '<div class="form-group row">
                <div class="alert alert-warning col-md-6 offset-md-4" role="alert" >
                    :message 
                </div>
            </div>') !!}
            @endif
            
            
            {{----New Password----}}
            <div class="form-group row">
                <label for='new_password' class="col-sm-4 col-form-label text-md-right">{{'New Password'}}</label>
                <div class="col-md-6">
                <input type='password' class="form-control" name='new_password' id='input_new_password'/>
                </div>
            </div>
            
            {!!$errors->first('new_password',
            '<div class="form-group row">
                <div class="alert alert-warning col-md-6 offset-md-4" role="alert" >
                    :message 
                </div>
            </div>') !!}
            
            
            {{----New password confirmation----}}
            <div class="form-group row">
                <label for='new_password_confirmation' class="col-sm-4 col-form-label text-md-right">{{'Password Confirmation'}}</label>
                <div class="col-md-6">
                <input type='password' class="form-control" name='new_password_confirmation' id='input_password_confirmation'/>
               
                </div>
            </div>
            
            {!!$errors->first('new_password_confirmation',
            '<div class="form-group row">
                <div class="alert alert-warning col-md-6 offset-md-4" role="alert" >
                    :message 
                </div>
            </div>') !!}
            
            {{----Button to show passwords----}}
            <div class="form-group row">
                <div class='offset-md-5'>
                <button type='button' class='btn btn-light' id='btn_show_password'>
                    <span class='mr-md-2' id='password_text'>Show Passwords</span>
                    <i class="far fa-eye-slash"></i>
                </button>
                </div>
            </div>
            
            
            
            {{----Old password not found error message----}}
            @if(isset($error_message))
            <div class="form-group row ">
                <div class="alert alert-warning col-md-6 offset-md-4 alert-dismissible" role="alert" >
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{$error_message}}
                </div>
            </div>
            @endif
            
            <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();">Change Password</button>
        </form>
                    </div>
            </div>
        </div>
    </div>
    
</div>

<script>
 //   var input_password_show=document.getElementById('input_password_show');
    var input_old_password=document.getElementById('input_old_password');
    var input_new_password=document.getElementById('input_new_password');
    var input_password_confirmation=document.getElementById('input_password_confirmation');
    var btn_show_password=document.getElementById('btn_show_password');
    var password_text=document.getElementById('password_text');
    
    btn_show_password.onmousedown=function(){
        password_text.innerHTML="Hide Passwords";
        btn_show_password.lastElementChild.className='far fa-eye';
        if(input_old_password !== null){
            input_old_password.type='text';
        }   
        input_new_password.type='text';
        input_password_confirmation.type='text';
    };
    
    btn_show_password.onmouseup=function(){
        btn_show_password.lastElementChild.className="far fa-eye-slash";
        password_text.innerHTML="Show Passwords";
        if(input_old_password !== null){
            input_old_password.type='password';
        }
        input_new_password.type='password';
        input_password_confirmation.type='password';
    };
    
    /*
    input_password_show.onclick=function(){
        if(input_password_show.checked){
            input_old_password.type='text';
            input_new_password.type='text';
            input_password_confirmation.type='text';
        }else{
            input_old_password.type='password';
            input_new_password.type='password';
            input_password_confirmation.type='password';
        }
    };
*/
</script>
@stop