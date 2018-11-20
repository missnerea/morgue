@extends('morgue.base')

@section('title')
{{'Registration page'}}
@stop

@section('content')
<div class='containter'>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ 'Admin Registration' }}</div>
                    <div class="card-body">
        <form method='post' action="{{route('admin_re.store')}}">
            {{csrf_field()}}
            
            {{----First Name----}}
            <div class="form-group row">
                <label for='first_name' class="col-sm-4 col-form-label text-md-right">{{'First Name'}}</label>
                <div class="col-md-6">
                <input type='text' class="form-control" name='first_name'/>
                </div>
            </div>
            
            {!!$errors->first('first_name',
            '<div class="form-group row">
                <div class="alert alert-warning col-md-6 offset-md-4 alert-dismissible" role="alert" >
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    :message 
                </div>
            </div>') !!}
            
            {{----Last Name----}}
            <div class="form-group row">
                <label for='last_name' class="col-sm-4 col-form-label text-md-right">{{'Last Name'}}</label>
                <div class="col-md-6">
                <input type='text' class="form-control" name='last_name'/>
                </div>
            </div>
            
            {!!$errors->first('last_name',
            '<div class="form-group row">
                <div class="alert alert-warning col-md-6 offset-md-4 alert-dismissible" role="alert" >
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    :message 
                </div>
            </div>') !!}
            
            {{----Gender----}}
            <div class="form-group row">
                <label for='gender' class="col-sm-4 col-form-label text-md-right">{{'Gender'}}</label>
                <div class="col-md-6">
                <div class="radio">
                <label><input type="radio" name="gender" value='male'>Male</label>
                <label><input type="radio" name="gender" value='female'>Female</label>
                </div>
                </div>
            </div>
            
            {!!$errors->first('gender',
            '<div class="form-group row">
                <div class="alert alert-warning col-md-6 offset-md-4 alert-dismissible" role="alert" >
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    :message 
                </div>
            </div>') !!}
            
            {{----ID number----}}
            <div class="form-group row">
                <label for='ID_number' class="col-sm-4 col-form-label text-md-right">{{'ID number'}}</label>
                <div class="col-md-6">
                <input type='text' class="form-control" name='ID_number'/>
                </div>
            </div>
            
            {!!$errors->first('ID_number',
            '<div class="form-group row">
                <div class="alert alert-warning col-md-6 offset-md-4 alert-dismissible" role="alert" >
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    :message 
                </div>
            </div>') !!}
            
            {{----Date of Birth----}}
            <div class="form-group row">
                <label for='dob' class="col-sm-4 col-form-label text-md-right">{{'Date of Birth'}}</label>
                <div class="col-md-6">
                <input type='date' class="form-control" name='dob'/>
                </div>
            </div>
            
            {!!$errors->first('dob',
            '<div class="form-group row">
                <div class="alert alert-warning col-md-6 offset-md-4 alert-dismissible" role="alert" >
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    :message 
                </div>
            </div>') !!}
            
            {{----Password----}}
            <div class="form-group row">
                <label for='password' class="col-sm-4 col-form-label text-md-right">{{'Password'}}</label>
                <div class="col-md-6">
                <input type='password' class="form-control" name='password'/>
                </div>
            </div>
            
            {!!$errors->first('password',
            '<div class="form-group row">
                <div class="alert alert-warning col-md-6 offset-md-4 alert-dismissible" role="alert" >
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    :message 
                </div>
            </div>') !!}
            
            {{----Password Confirmation----}}
            <div class="form-group row">
                <label for='password' class="col-sm-4 col-form-label text-md-right">{{'Password Confirmation'}}</label>
                <div class="col-md-6">
                <input type='password' class="form-control" name='password_confirmation'/>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@stop