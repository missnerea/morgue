@extends('morgue.base')

@section('title')
{{'Undertaker Delete'}}
@stop

@section('content')

<div class='containter'>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ 'Delete Undertaker' }}</div>
                    <div class="card-body">
                        <form method='post' action="{{route('undertaker_re.destroy',['id'=>$user->id])}}">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="DELETE">
            
            {{----First Name----}}
            <div class="form-group row">
                <label for='first_name' class="col-sm-4 col-form-label text-md-right">{{'First Name'}}</label>
                <div class="col-md-6">
                    <input type='text' class="form-control" name='first_name' value="{{$user->first_name}}" disabled/>
                </div>
            </div>
            
            {{----Last Name----}}
            <div class="form-group row">
                <label for='last_name' class="col-sm-4 col-form-label text-md-right">{{'Last Name'}}</label>
                <div class="col-md-6">
                <input type='text' class="form-control" name='last_name' value="{{$user->last_name}}" disabled/>
                </div>
            </div>
            
            {{----Gender----}}
            <div class="form-group row">
                <label for='gender' class="col-sm-4 col-form-label text-md-right">{{'Gender'}}</label>
                <div class="col-md-6">
                <input type='text' class='form-control' name='gender' value="{{$user->gender}}"disabled/>
                </div>
            </div>
            
            {{----ID Number----}}
            <div class="form-group row">
                <label for='ID_number' class="col-sm-4 col-form-label text-md-right">{{'ID number'}}</label>
                <div class="col-md-6">
                <input type='text' class="form-control" name='ID_number' value="{{$user->id_number}}" disabled/>
                </div>
            </div>
            
            {{----Date of Birth----}}
            <div class="form-group row">
                <label for='dob' class="col-sm-4 col-form-label text-md-right">{{'Date of Birth'}}</label>
                <div class="col-md-6">
                <input type='date' class="form-control" name='dob' value="{{$user->date_of_birth}}" disabled/>
                </div>
            </div>
            
            {{----Creator Admin ID----}}
            <div class="form-group row">
                <label for='admin_id' class="col-sm-4 col-form-label text-md-right">{{'Creator Admin ID'}}</label>
                <div class="col-md-6">
                <input type='text' class="form-control" name='admin_id' value="{{$user->admin_id}}"  disabled/>
                </div>
            </div>
            
            {{----Submit Button----}}
             <button type="submit" class="btn btn-primary">Delete</button>
        </form>
                    </div>
            </div>
        </div>
    </div>
</div>

@stop
