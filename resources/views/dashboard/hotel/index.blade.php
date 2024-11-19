@extends('dashboard.master')

@section('content')
    <a href="{{route('hotel.create')}}" target='blank'>Create</a>
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
                    Dirección
                </td>
                <td>
                    Teléfono
                </td>
                <td>
                    Email
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    @foreach ($hotels as $h)
                        <tr>
                            <td>
                                {{ $h -> id }}
                            </td>
                            <td>
                                {{ $h -> name }}
                            </td>
                            <td>
                                {{ $h -> adress }}
                            </td>
                            <td>
                                {{ $h -> phoneNumber }}
                            </td>
                            <td>
                                {{ $h -> email }}
                            </td>
                            <td>
                                {{ $h -> website }}
                            </td>
                            <td>
                                <a href="{{route('hotel.edit', $h)}}">Edit</a>
                                <a href="{{route('hotel.show', $h)}}">Show</a>
                                <form action="{{route('hotel.destroy', $h)}}" method='post'>
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
    {{$hotels->links()}}
@endsection