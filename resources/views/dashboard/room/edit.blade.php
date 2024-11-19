@extends('dashboard.master')

@section('content')
    @include('dashboard.fragment._errors-form')
    <form action="{{route('room.update', $room->id)}}" method='post' enctype="multipart/form-data">
        @method('PATCH')
    @include('dashboard.room._form', ['task'=>'edit'])
    </form>
@endsection