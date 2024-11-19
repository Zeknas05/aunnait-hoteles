@csrf

<label for="">Nombre</label>
<input type="text" name="name" value='{{old('name', $service->name)}}'>

<label for="">Descripción</label>
<input type="text" name="description" value='{{old('description', $service->description)}}'>

<button type='submit'>Send</button>