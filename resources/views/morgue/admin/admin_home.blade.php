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
<div class="container">
    <div class='row'>
        <div class='col-md-2'>
            <input type='button' onclick="document.location.href='{{route('undertaker_re.create')}}'" value="Create Undertaker"/>
        </div>
        
        <div class='col-md-2'>
            <input type='button' onclick="document.location.href='{{route('admin_re.create')}}'" value="Create Admin"/>
        </div>
        
        <div class='col-md-2'>
            <input type='button' onclick="document.location.href='{{route('admin_re.show',['id'=>$current_user->id])}}'" value="View Personal Data"/>
        </div>
    
    </div>
</div>
@stop


