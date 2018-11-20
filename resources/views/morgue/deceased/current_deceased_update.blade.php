@extends('morgue.base')

@section('title')
{{'Deceased Update'}}
@stop

@section('content')

<div class='containter'>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ 'Deceased update page' }}</div>
                    <div class="card-body">
                        
                        
                        <form method='post' action="{{route('deceased_re.update',['id'=>$deceased->id])}}">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PATCH">
            
            {{----First Name----}}
            <div class="form-group row">
                <label for='first_name' class="col-sm-4 col-form-label text-md-right">{{'First Name'}}</label>
                <div class="col-md-6">
                    <input type='text' class="form-control" name='first_name' value='{{$deceased->first_name}}'/>
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
                <input type='text' class="form-control" name='last_name' value='{{$deceased->last_name}}'/>
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
                <label><input type="radio" name="gender" value='male' id='radio_male'>Male</label>
                <label><input type="radio" name="gender" value='female' id='radio_female'>Female</label>
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
            
            
            {{----Cause of Death----}}
            <div class="form-group row">
                <label for='ID_number' class="col-sm-4 col-form-label text-md-right">{{'Cause of Death'}}</label>
                <div class="col-md-6">
                <input type='text' class="form-control" name='cause_of_death' value='{{$deceased->cause_of_death}}'/>
                </div>
            </div>
            
            {!!$errors->first('cause_of_death',
            '<div class="form-group row">
                <div class="alert alert-warning col-md-6 offset-md-4 alert-dismissible" role="alert" >
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    :message 
                </div>
            </div>') !!}
            
            {{----Date In----}}
            <div class="form-group row">
                <label for='dob' class="col-sm-4 col-form-label text-md-right">{{'Date In'}}</label>
                <div class="col-md-6">
                <input type='date' class="form-control" name='date_in' value='{{$deceased->date_in}}'/>
                </div>
            </div>
            
            {!!$errors->first('date_in',
            '<div class="form-group row">
                <div class="alert alert-warning col-md-6 offset-md-4 alert-dismissible" role="alert" >
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    :message 
                </div>
            </div>') !!}
            
            {{----Submit button----}}
            <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();">Submit</button>
        </form>
                    </div>
            </div>
        </div>
    </div>
</div>


<script>
var radio_male=document.getElementById('radio_male');
var radio_female=document.getElementById('radio_female');
var gender='{{$deceased->gender}}';

if(gender==='male'){
    radio_male.checked=true;
}else{
    radio_female.checked=true;
}
</script>
@stop