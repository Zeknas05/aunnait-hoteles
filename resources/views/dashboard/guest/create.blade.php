@extends('dashboard.master')

@section('content')
    @include('dashboard.fragment._errors-form')
    <form action="{{route('guest.store')}}" method=post>
        @include('dashboard.guest._form')
    </form>
@endsection