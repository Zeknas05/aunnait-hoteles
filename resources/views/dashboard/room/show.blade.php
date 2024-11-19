@extends('dashboard.master')

@section('content')

    <h1> {{$room->number}} </h1>
    <div> 
        {{$room->type}} 
    </div>
    <div> 
        {{$room->nightPrice}} 
    </div>
    <div>
        {{$room->hotel->name}}
    </div>
    
@endsection