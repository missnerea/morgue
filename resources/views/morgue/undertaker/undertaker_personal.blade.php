@extends('morgue.base')

@section('title')
{{'Undertaker personal info'}}
@stop

@section('content')
<div class='containter'>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ 'Undertaker Personal information' }}</div>
                    <div class="card-body">
        <form method='post'>
            {{csrf_field()}}
            <div class="form-group row">
                <label for='first_name' class="col-sm-4 col-form-label text-md-right">{{'First Name'}}</label>
                <div class="col-md-6">
                    <input type='text' class="form-control" name='first_name' value="{{$user->first_name}}" disabled/>
                </div>
            </div>
            
            <div class="form-group row">
                <label for='last_name' class="col-sm-4 col-form-label text-md-right">{{'Last Name'}}</label>
                <div class="col-md-6">
                <input type='text' class="form-control" name='last_name' value="{{$user->last_name}}" disabled/>
                </div>
            </div>
            
            <div class="form-group row">
                <label for='gender' class="col-sm-4 col-form-label text-md-right">{{'Gender'}}</label>
                <div class="col-md-6">
                <input type='text' class='form-control' name='gender' value="{{$user->gender}}"disabled/>
                </div>
            </div>
            
            <div class="form-group row">
                <label for='ID_number' class="col-sm-4 col-form-label text-md-right">{{'ID number'}}</label>
                <div class="col-md-6">
                <input type='text' class="form-control" name='ID_number' value="{{$user->id_number}}" disabled/>
                </div>
            </div>
            
            <div class="form-group row">
                <label for='dob' class="col-sm-4 col-form-label text-md-right">{{'Date of Birth'}}</label>
                <div class="col-md-6">
                <input type='date' class="form-control" name='dob' value="{{$user->date_of_birth}}" disabled/>
                </div>
            </div>
            
            <div class="form-group row">
                <label for='admin_id' class="col-sm-4 col-form-label text-md-right">{{'Creator Admin ID'}}</label>
                <div class="col-md-6">
                <input type='text' class="form-control" name='admin_id' value="{{$user->admin_id}}"  disabled/>
                </div>
            </div>
        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@stop