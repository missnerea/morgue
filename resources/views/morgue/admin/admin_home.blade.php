
@extends('morgue.base')

@section('title')
{{'Admin Home'}}
@stop

@section('content')
<?php
$current_user=Auth::guard('admin')->user();
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!--
  <a class="navbar-brand" href="#">Admin Home</a>
  

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <p class='navbar-text mr-sm-5'>}</p>
    <button type="button" class="btn btn-primary navbar-btn my-2 my-sm-0">Logout</button>
  </div>
    -->
    <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Admin Home</a>
    </div>
    
    <ul class="nav navbar-nav navbar-right">
     <p class='navbar-text mr-sm-5'>{{Auth::guard('admin')->user()->first_name}}</p>
      <button type="button" class="btn btn-primary navbar-btn my-2 my-sm-0" onclick="document.location.href='{{route('admin.logout')}}'">Logout</button>
    </ul>
  </div>
</nav>
<div class="container-fluid">
    <div class='row'>
        <h3>Admin Section</h3>
        <div class='col-md-2'>
            <input type='button' onclick="document.location.href='{{route('admin_re.create')}}'" value="Create Admin"/>
        </div>
        
        <div class='col-md-2'>
            <input type='button' onclick="document.location.href='{{route('admin_re.show',['id'=>$current_user->id])}}'" value="View Personal Data"/>
        </div>
        
        <div class='col-md-2'>
            <input type='button' onclick="document.location.href='{{route('admin_re.edit',['id'=>$current_user->id])}}'" value="Update Personal data"/>
        </div>
        
        <div class='col-md-2'>
            <input type='button' onclick="document.location.href='{{route('admin_re.show_password_change',['id'=>$current_user->id])}}'" value="Change Password"/>
        </div>
        
        {{----Super Admin section----}}
        @if(Gate::forUser($current_user)->allows('super-admin'))
        <div class='col-md-2'>
            <input type='button' onclick="document.location.href='{{route('admin_re.showsearch')}}'" value="View administrators"/>
        </div>
        @endif
        
    </div>
    
    <div class="row">
        <h3>Undertaker Section</h3>
        <div class='col-md-2'>
            <input type='button' onclick="document.location.href='{{route('undertaker_re.create')}}'" value="Create Undertaker"/>
        </div>
        
        <div class='col-md-2'>
            <input type='button' onclick="document.location.href='{{route('undertaker_re.showsearch')}}'" value="View Undertakers"/>
        </div>
    </div>
    
    <div class="row">
        <h3>Deceased Section</h3>
        
        <div class='col-md-2'>
            <input type='button' onclick="document.location.href='{{route('deceased_re.create')}}'" value="Register Deceased"/>
        </div>
        
        <div class='col-md-2'>
            <input type='button' onclick="document.location.href='{{route('deceased_re.showsearch')}}'" value="View currently held deceased"/>
        </div>
        
        <div class='col-md-2'>
            <input type='button' onclick="document.location.href='{{route('released_deceased_re.showsearch')}}'" value="View released deceased"/>
        </div>
    
    </div>
    
    @if(isset($message))
    <div class='row justify-content-center'>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            Hello there
          </div>
    </div>
    @endif
</div>
@stop

