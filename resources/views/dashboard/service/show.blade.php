@extends('dashboard.master')

@section('content')

    <h1> {{$service->name}} </h1>
    <div> 
        {{$service->description}} 
    </div>
    
@endsection