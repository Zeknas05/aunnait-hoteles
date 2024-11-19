@extends('dashboard.master')

@section('content')
    @include('dashboard.fragment._errors-form')
    <form action="{{route('service.update', $service->id)}}" method='post' enctype="multipart/form-data">
        @method('PATCH')
    @include('dashboard.service._form', ['task'=>'edit'])
    </form>
@endsection