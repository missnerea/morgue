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
                <label for='gender' class="col-sm-4 col-form-label text-md-right">{{'Gender'}}</label>
                <div class="col-md-6">
                <div class="radio">
                <label><input type="radio" name="gender" value='male'>Male</label>
                <label><input type="radio" name="gender" value='female'>Female</label>
                </div>
                </div>
            </div>
            
            <div class="form-group row">
                <label for='ID_number' class="col-sm-4 col-form-label text-md-right">{{'ID number'}}</label>
                <div class="col-md-6">
                <input type='text' class="form-control" name='ID_number'/>
                </div>
            </div>
            
            <div class="form-group row">
                <label for='dob' class="col-sm-4 col-form-label text-md-right">{{'Date of Birth'}}</label>
                <div class="col-md-6">
                <input type='date' class="form-control" name='dob'/>
                </div>
            </div>
            
            <div class="form-group row">
                <label for='password' class="col-sm-4 col-form-label text-md-right">{{'Password'}}</label>
                <div class="col-md-6">
                <input type='password' class="form-control" name='password'/>
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