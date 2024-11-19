@extends('dashboard.master')

@section('content')
    @include('dashboard.fragment._errors-form')
    <form action="{{route('room.store')}}" method=post>
        @include('dashboard.room._form')
    </form>
@endsection