@extends('dashboard.master')

@section('content')
    @include('dashboard.fragment._errors-form')
    <form action="{{route('hotel.store')}}" method=post>
        @include('dashboard.hotel._form')
    </form>
@endsection