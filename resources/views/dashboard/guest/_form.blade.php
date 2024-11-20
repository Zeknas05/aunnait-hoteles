@csrf

<label for="">Nombre</label>
<input type="text" name="name" value='{{old('name', $guest->name)}}'>

<label for="">Apellido</label>
<input type="text" name="surname" value='{{old('surname', $guest->surname)}}'>

<label for="">DNI o Pasaporte</label>
<input type="text" name="passportID" value='{{old('passportID', $guest->passportID)}}'>

<label for="">Fecha de entrada</label>
<input type="date" name="checkinDate" value='{{old('checkinDate', $guest->checkinDate)}}'>

<label for="">Fecha de salida</label>
<input type="date" name="checkoutDate" value='{{old('checkoutDate', $guest->checkoutDate)}}'>

<label for="">Habitación</label>
<select name="roomId">
    @foreach ($rooms as $number=>$id)
        <option  {{old('roomId', $guest->roomId)  == $id ? 'selected' : ''}} value="{{$id}}">{{$number}}</option>
    @endforeach
</select>

<button type='submit'>Send</button>