@extends('dashboard.master')

@section('content')
    <a href="{{route('room.create')}}" target='blank'>Create</a>
    <table>
        <thead>
            <tr>
                <td>
                    ID
                </td>
                <td>
                    Número
                </td>
                <td>
                    Tipo
                </td>
                <td>
                    Precio por noche
                </td>
                <td>
                    Hotel
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    @foreach ($rooms as $r)
                        <tr>
                            <td>
                                {{ $r->id }}
                            </td>
                            <td>
                                {{ $r->number }}
                            </td>
                            <td>
                                {{ $r->type }}
                            </td>
                            <td>
                                {{ $r->nightPrice }}
                            </td>
                            <td>
                                {{ $r->hotel->name }}
                            </td>
                            <td>
                                <a href="{{route('room.edit', $r)}}">Edit</a>
                                <a href="{{route('room.show', $r)}}">Show</a>
                                <form action="{{route('room.destroy', $r)}}" method='post'>
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
    {{$rooms->links()}}
@endsection