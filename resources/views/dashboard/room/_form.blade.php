@csrf

<label for="">Número</label>
<input type="text" name="number" value='{{old('number', $room->number)}}'>

<label for="">Tipo</label>
<input type="text" name="type" value='{{old('type', $room->type)}}'>

<label for="">Precio por noche</label>
<input type="text" name="nightPrice" value='{{old('phoneNumber', $room->nightPrice)}}'>

<button type='submit'>Send</button>