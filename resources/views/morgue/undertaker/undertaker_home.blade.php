@extends('morgue.base')

@section('title')
{{'Undertaker Home'}}
@stop

@section('content')
<?php
$current_user=Auth::guard('undertaker')->user();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Undertaker Home</a>
    </div>
    
    <ul class="nav navbar-nav navbar-right">
     <p class='navbar-text mr-sm-5'>{{Auth::guard('undertaker')->user()->first_name}}</p>
      <button type="button" class="btn btn-primary navbar-btn my-2 my-sm-0" onclick="document.location.href='{{route('undertaker.logout')}}'">Logout</button>
    </ul>
  </div>
</nav>

<div class="container-fluid">
    <div class='row'>
        <h3>Undertaker Section</h3>
        <div class='col-md-2'>
            <input type='button' onclick="document.location.href='{{route('undertaker_re.show',['id'=>$current_user->id])}}'" value="View Personal Data"/>
        </div>
        
        <div class='col-md-2'>
            <input type='button' onclick="document.location.href='{{route('undertaker_re.edit',['id'=>$current_user->id])}}'" value="Update Personal Data"/>
        </div>
        
        <div class='col-md-2'>
            <input type='button' onclick="document.location.href='{{route('undertaker_re.show_password_change',['id'=>$current_user->id])}}'" value="Change Password"/>
        </div>
    </div>
    
    <div class="row">
        <h3>Deceased Section</h3>
        
        <div class='col-md-2'>
            <input type='button' onclick="document.location.href='{{route('deceased_re.create')}}'" value="Register Deceased"/>
        </div>
        
        <div class='col-md-2'>
            <input type='button' onclick="document.location.href='{{route('deceased_re.showsearch')}}'" value="View currently held Deceased"/>
        </div>
        
        <div class='col-md-2'>
            <input type='button' onclick="document.location.href='{{route('released_deceased_re.showsearch')}}'" value="View released deceased"/>
        </div>
    </div>
</div>
@stop
