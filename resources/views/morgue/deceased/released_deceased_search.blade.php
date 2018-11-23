@extends('morgue.base')

@section('title')
{{'Deceased Search'}}
@stop

@section('style')
<style>
 .button-active{
    border:3px solid green;
 }
 </style>
@stop

@section('content')

<div class='container-fluid'>
    <div class="row justify-content-center">
        {{----Search Form----}}
        <div class="card">
            <div class="card-body">
                    <form class="form-inline" role="form" method='post' action="{{route('released_deceased_re.search')}}">
                        {{csrf_field()}}
                        
                        {{----Column----}}
                        <label for='column' class="mr-sm-2">Column</label>
                        <select class="form-control mr-sm-2" name="column" id='select_column'>
                            <option value="id">ID</option>
                            <option value="first_name">First Name</option>
                            <option value="last_name">Last Name</option>
                            <option value="gender">Gender</option>
                            <option value="cause_of_death">Cause of Death</option>
                            <option value="date_in">Date In</option>
                            <option value="date_out">Date Out</option>
                            <option value="charges">Charges</option>
                        </select>
                        
                        {{----Operator----}}
                        <label for='operator' class="mr-sm-2">Condition</label>
                        <select class="form-control mr-sm-2" name="operator" id='select_operator'>
                            <option value='='>equals to</option>
                            <option value='>'>greater than</option>
                            <option value='<'>less than</option>
                            <option value='>='>greater than or equals to</option>
                            <option value='<='>less than or equals to</option>
                            <option value='!='>not equals to</option>
                        </select>
                        
                        {{----Value----}}
                        <label for='value' class="mr-sm-2">Value</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" name="value" id='input_date'/>
                        
                        {{----Submit Button----}}
                        <button type="submit" class="btn btn-primary mb-2" onclick="this.disabled=true;this.form.submit();">Search</button>
                    </form>
                
            
            </div>
        </div> 
        
         <div class="col-md-3">
        {{----Return all records button----}}
        <button type="button" class="btn btn-primary mt-3" onclick="document.location.href='{{route('released_deceased_re.return_all_records')}}'">Show all records</button>
        </div>
    </div>
</div>



@if(isset($records))
<div class='container mt-md-3'>
    
    {{----Update and Delete buttons----}}
    <div class="row justify-content-center m-sm-2">
        
        {{----Update Button----}}
        <div class="col-md-2">
            <input type="button" value="Update" class="btn button-active" id="button_update"/>
        </div>
        
        {{----Delete Button----}}
        <div class="col-md-2">
            <input type="button" value="Delete" class="btn " id="button_delete"/>
        </div>
        
    </div>
    
    <div class="row  justify-content-center">
        
        {{----Current Deceased Table----}}
        <div class="col-md-11">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Cause of Death</th>
                    <th scope="col">Date In</th>
                    <th scope="col">Date Out</th>
                    <th scope="col">Charges</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                <tr>
                    <th scope="row">{{$record->id}}</th>
                    <td>{{$record->first_name}}</td>
                    <td>{{$record->last_name}}</td>
                    <td>{{$record->gender}}</td>
                    <td>{{$record->cause_of_death}}</td>
                    <td>{{$record->date_in}}</td>
                    <td>{{$record->date_out}}</td>
                    <td>{{$record->charges}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
            {{----No records found message----}}
            @if($records->isEmpty())
            <p class="text-center">No records were found</p>
            @endif
        {{$records->links()}}
        </div>
        </div>
</div>
@endif

<script src="{{asset('js/released_deceased_search.js')}}"></script>
@stop
