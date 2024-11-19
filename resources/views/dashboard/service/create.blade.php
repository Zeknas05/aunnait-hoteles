@extends('dashboard.master')

@section('content')
    @include('dashboard.fragment._errors-form')
    <form action="{{route('service.store')}}" method=post>
        @include('dashboard.service._form')
    </form>
@endsection