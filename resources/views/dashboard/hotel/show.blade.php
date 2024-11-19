@extends('dashboard.master')

@section('content')

    <h1> {{$hotel->name}} </h1>
    <div> 
        {{$hotel->adress}} 
    </div>
    <div> 
        {{$hotel->phoneNumber}} 
    </div>
    <div>
        {{$hotel->email}}
    </div>
    <div>
        {{$hotel->website}}
    </div>
    
@endsection