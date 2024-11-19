@csrf

<label for="">Nombre</label>
<input type="text" name="name" value='{{old('name', $hotel->title)}}'>

<label for="">Dirección</label>
<input type="text" name="adress" value='{{old('adress', $hotel->slug)}}'>

<label for="">Teléfono</label>
<input type="text" name="phoneNumber" value='{{old('phoneNumber', $hotel->slug)}}'>

<label for="">Email</label>
<input type="text" name="email" value='{{old('email', $hotel->slug)}}'>

<label for="">Website</label>
<input type="text" name="website" value='{{old('website', $hotel->slug)}}'>

<button type='submit'>Send</button>