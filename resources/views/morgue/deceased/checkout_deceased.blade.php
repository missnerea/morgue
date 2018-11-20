@extends('morgue.base')

@section('title')
{{'Checkout Deceased'}}
@stop

@section('content')

<div class='containter'>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ 'Deceased Checkout page' }}</div>
                    <div class="card-body">
                        
                        
                        <form method='post' action="{{route('released_deceased_re.store')}}">
            {{csrf_field()}}
            
            {{----First Name----}}
            <div class="form-group row">
                <label for='first_name' class="col-sm-4 col-form-label text-md-right">{{'First Name'}}</label>
                <div class="col-md-6">
                    <input type='text' class="form-control" name='first_name' value='{{$deceased->first_name}}' readonly/>
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
                <input type='text' class="form-control" name='last_name' value='{{$deceased->last_name}}' readonly/>
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
                <label><input type="radio" name="gender" value='male' id='radio_male' readonly>Male</label>
                <label><input type="radio" name="gender" value='female' id='radio_female' readonly>Female</label>
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
                <label for='cause_of_death' class="col-sm-4 col-form-label text-md-right">{{'Cause of Death'}}</label>
                <div class="col-md-6">
                <input type='text' class="form-control" name='cause_of_death' value='{{$deceased->cause_of_death}}' readonly/>
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
                <label for='date_in' class="col-sm-4 col-form-label text-md-right">{{'Date In'}}</label>
                <div class="col-md-6">
                <input type='date' class="form-control" name='date_in' value='{{$deceased->date_in}}' readonly id="date_in"/>
                </div>
            </div>
            
            {!!$errors->first('date_in',
            '<div class="form-group row">
                <div class="alert alert-warning col-md-6 offset-md-4 alert-dismissible" role="alert" >
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    :message 
                </div>
            </div>') !!}
            
            {{----Date Out----}}
            <div class="form-group row">
                <label for='date_out' class="col-sm-4 col-form-label text-md-right">{{'Date Out'}}</label>
                <div class="col-md-6">
                    <input type='date' class="form-control" name='date_out' id="date_out"/>
                </div>
            </div>
            
            {!!$errors->first('date_out',
            '<div class="form-group row">
                <div class="alert alert-warning col-md-6 offset-md-4 alert-dismissible" role="alert" >
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    :message 
                </div>
            </div>') !!}
            
            {{----Charges----}}
            <div class="form-group row">
                <label for='charges' class="col-sm-4 col-form-label text-md-right">{{'Charges'}}</label>
                <div class="col-md-6">
                    <input type='text' class="form-control" name='charges' id="charges"/>
                </div>
            </div>
            
            {!!$errors->first('charges',
            '<div class="form-group row">
                <div class="alert alert-warning col-md-6 offset-md-4 alert-dismissible" role="alert" >
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    :message 
                </div>
            </div>') !!}
            
            <input type="hidden" name="id" value="{{$deceased->id}}"/>
            
            {{----Submit button----}}
            <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();">Submit</button>
        </form>
                    </div>
            </div>
        </div>
    </div>
</div>


<script>
////////////////////Setting gender radio button//////////////////////////////////////////
var radio_male=document.getElementById('radio_male');
var radio_female=document.getElementById('radio_female');
var gender='{{$deceased->gender}}';

if(gender==='male'){
    radio_male.checked=true;
}else{
    radio_female.checked=true;
}

////////////////////Calculating charges////////////////////////////////////////////////
var input_date_in=document.getElementById('date_in');
var input_date_out=document.getElementById('date_out');
var input_charges=document.getElementById('charges');

date_out.oninput=function(){
    var date_in=new Date(input_date_in.value).getTime();
    var date_out=new Date(input_date_out.value).getTime();
    var days=dateDiff(date_in,date_out);
    input_charges.value=days*500;
}

function dateDiff(date_in,date_out){
    var timeDiff = Math.abs(date_out- date_in);
    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
    return diffDays;
}
</script>

@stop