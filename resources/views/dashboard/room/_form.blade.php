@csrf

<label for="">Número</label>
<input type="text" name="number" value='{{old('number', $room->number)}}'>

<label for="">Tipo</label>
<input type="text" name="type" value='{{old('type', $room->type)}}'>

<label for="">Precio por noche</label>
<input type="text" name="nightPrice" value='{{old('phoneNumber', $room->nightPrice)}}'>

<label for="">Hotel</label>
<select name="hotel_id">
    @foreach ($hotels as $number=>$id)
        <option  {{old('hotel_id', $room->hotel_id)  == $id ? 'selected' : ''}} value="{{$id}}">{{$number}}</option>
    @endforeach
</select>

<button type='submit'>Send</button>