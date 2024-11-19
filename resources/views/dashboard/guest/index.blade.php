@extends('dashboard.master')

@section('content')
    <a href="{{route('guest.create')}}" target='blank'>Create</a>
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
                    Apellidos
                </td>
                <td>
                    Pasaporte/DNI
                </td>
                <td>
                    Fecha de entrada
                </td>
                <td>
                    Fecha de salida
                </td>
                <td>
                    Habitación
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    @foreach ($guests as $g)
                        <tr>
                            <td>
                                {{ $g->id }}
                            </td>
                            <td>
                                {{ $g->name }}
                            </td>
                            <td>
                                {{ $g->surname }}
                            </td>
                            <td>
                                {{ $g->passportID }}
                            </td>
                            <td>
                                {{ $g->checkinDate }}
                            </td>
                            <td>
                                {{ $g->checkoutDate }}
                            </td>
                            <td>
                                {{ $g->room->number }}
                            </td>
                            <td>
                                <a href="{{route('guest.edit', $g)}}">Edit</a>
                                <a href="{{route('guest.show', $g)}}">Show</a>
                                <form action="{{route('guest.destroy', $g)}}" method='post'>
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
    {{$guests->links()}}
@endsection