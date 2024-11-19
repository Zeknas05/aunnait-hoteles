@extends('dashboard.master')

@section('content')
    <a href="{{route('service.create')}}" target='blank'>Create</a>
    <table>
        <thead>
            <tr>
                <td>
                    ID
                </td>
                <td>
                    Nombre
                </td>
                <td>
                    Descripción
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    @foreach ($services as $s)
                        <tr>
                            <td>
                                {{ $s->id }}
                            </td>
                            <td>
                                {{ $s->name }}
                            </td>
                            <td>
                                {{ $s->description }}
                            </td>
                            <td>
                                <a href="{{route('service.edit', $s)}}">Edit</a>
                                <a href="{{route('service.show', $s)}}">Show</a>
                                <form action="{{route('service.destroy', $s)}}" method='post'>
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>
    {{$services->links()}}
@endsection