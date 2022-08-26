
<div class="alert alert-secondary" role="alert">
    <h4 class="alert-heading">{{$modo}} Empleado</h4>
</div>
<div style="margin:0 20px;">
        
    @if(count($errors)>0)
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul> 
        </div>
    @endif

    <!-- form -->
    <div class="form-group">
        <label for="Nombres">Nombre</label>
        <input class="form-control" type="text" value="{{ isset($empleado->Nombres)?$empleado->Nombres:old('Nombres') }}" name="Nombres" id="Nombres">
    </div>
    <div class="form-group">
        <label for="Apellidos">Apellidos</label>
        <input class="form-control" type="text" value="{{ isset($empleado->Apellidos)?$empleado->Apellidos:old('Apellidos') }}" name="Apellidos"  id="Apellidos">
    </div>
    <div class="form-group">
        <label for="Correo">Correo</label>
        <input  class="form-control" type="email" value="{{ isset($empleado->correo)?$empleado->correo:old('Correo') }}" name="Correo" id="Correo">
    </div>
    <div class="form-group">
        <label for="Area">Area</label>
        <input class="form-control" type="combobox" value="{{ isset($empleado->Area)?$empleado->Area:old('Area') }}" name="Area" id="Area">
    </div>
    <div class="form-group">
        <label for="Foto">Foto</label>
        @if(isset($empleado->Foto))
        <br>
            <img src="{{asset('storage').'/'.$empleado->Foto}}" alt="" class="img-fluid img-thumbnail mt-2 mb-3" width="200">
        @endif
        <input class="form-control" type="file" value="" name="Foto">
    </div>

        <input class="btn btn-success mt-4" type="submit" value="{{$modo}}" style="width:120px;">
        <a class="btn btn-primary mt-4" href="{{url('empleado/')}}" style="width:120px;">Regresar</a>
    <!-- endform -->
</div>