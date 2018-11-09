@extends('morgue.base')

@section('title')
{{'Login page'}}
@stop

@section('content')
<div class='containter'>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ 'Login' }}</div>
                    <div class="card-body">
        <form method='post' id="form_login" action="{{route('admin.login')}}" >
            {{csrf_field()}}
            <div class="form-group row">
                <label for='first_name' class="col-sm-4 col-form-label text-md-right">{{'First Name'}}</label>
                <div class="col-md-6">
                <input type='text' class="form-control" name='first_name'/>
                </div>
            </div>
            
            <div class="form-group row">
                <label for='last_name' class="col-sm-4 col-form-label text-md-right">{{'Last Name'}}</label>
                <div class="col-md-6">
                <input type='text' class="form-control" name='last_name'/>
                </div>
            </div>
            
            <div class="form-group row">
                <label for='password' class="col-sm-4 col-form-label text-md-right">{{'Password'}}</label>
                <div class="col-md-6">
                <input type='password' class="form-control" name='password'/>
                </div>
            </div>
            
            <div class="form-group row">
                <label for='select_role' class="col-sm-4 col-form-label text-md-right">{{'Select Role'}}</label>
                <div class="col-md-6">
                    <select class="form-control" id="select_role">
                        <option value="admin">Administrator</option>
                        <option value="undertaker">Undertaker</option>
                    </select>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary" id="btn_login">Login</button>
        </form>
                    </div>
            </div>
        </div>
    </div>
</div>

<script>
    var login_btn=document.getElementById('btn_login');
    var select_role=document.getElementById('select_role');
    var form_login=document.getElementById('form_login');
    
    select_role.onclick=function(){
        if(select_role.value==='admin'){
            form_login.action='{{route('admin.login')}}';
        }else if(select_role.value==='undertaker'){
            form_login.action='{{route('undertaker.login')}}';
        }
    };
    /*
    login_btn.onclick=function(){
        if(select_role.value==='admin'){
            document.location.href='{{route('admin.login')}}';
        }
    }
    */
</script>
@stop