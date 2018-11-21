@extends('morgue.base')

@section('title')
{{'Deceased Delete'}}
@stop

@section('content')

<div class='containter'>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ 'Delete Checked Out Deceased' }}</div>
                    <div class="card-body">
                        <form method='post' action="{{route('released_deceased_re.destroy',['id'=>$user->id])}}">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="DELETE">
            
            {{----ID----}}
            <div class="form-group row">
                <label for='id' class="col-sm-4 col-form-label text-md-right">{{'ID'}}</label>
                <div class="col-md-6">
                    <input type='text' class="form-control" name='id' value="{{$user->id}}" disabled/>
                </div>
            </div>
            
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
            
            {{----Cause of Death----}}
            <div class="form-group row">
                <label for='cause_of_death' class="col-sm-4 col-form-label text-md-right">{{'Cause of Death'}}</label>
                <div class="col-md-6">
                <input type='text' class="form-control" name='cause_of_death' value="{{$user->cause_of_death}}" disabled/>
                </div>
            </div>
            
            {{----Date In----}}
            <div class="form-group row">
                <label for='date_in' class="col-sm-4 col-form-label text-md-right">{{'Date In'}}</label>
                <div class="col-md-6">
                <input type='date' class="form-control" name='date_in' value="{{$user->date_in}}" disabled/>
                </div>
            </div>
            
            {{----Date Out----}}
            <div class="form-group row">
                <label for='date_out' class="col-sm-4 col-form-label text-md-right">{{'Date Out'}}</label>
                <div class="col-md-6">
                <input type='date' class="form-control" name='date_out' value="{{$user->date_out}}" disabled/>
                </div>
            </div>
            
            {{----Charges----}}
            <div class="form-group row">
                <label for='date_in' class="col-sm-4 col-form-label text-md-right">{{'Charges'}}</label>
                <div class="col-md-6">
                <input type='text' class="form-control" name='charges' value="{{$user->charges}}" disabled/>
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

