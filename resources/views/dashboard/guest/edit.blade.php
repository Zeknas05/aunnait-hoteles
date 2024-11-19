@extends('dashboard.master')

@section('content')
    @include('dashboard.fragment._errors-form')
    <form action="{{route('guest.update', $guest->id)}}" method='post' enctype="multipart/form-data">
        @method('PATCH')
    @include('dashboard.guest._form', ['task'=>'edit'])
    </form>
@endsection