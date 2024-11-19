@extends('dashboard.master')

@section('content')

    <h1> {{$guest->name}} </h1>
    <div> 
        {{$guest->surname}} 
    </div>
    <div> 
        {{$guest->passportID}} 
    </div>
    <div>
        {{$guest->checkinDate}}
    </div>
    <div>
        {{$guest->checkoutDate}}
    </div>
    <div>
        {{$guest->room->number}}
    </div>
@endsection