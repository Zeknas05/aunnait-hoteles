@extends('dashboard.master')

@section('content')
    @include('dashboard.fragment._errors-form')
    <form action="{{route('hotel.update', $hotel->id)}}" method='post' enctype="multipart/form-data">
        @method('PATCH')
    @include('dashboard.hotel._form', ['task'=>'edit'])
    </form>
@endsection