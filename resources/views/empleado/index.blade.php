@extends('layouts.app')

@section('content')
<div class="container">
        @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session::get('mensaje')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"></span>
            </button>
        </div>
        @endif

    <a href="{{url('empleado/create')}}" class="btn btn-success mb-4">Registrar Nuevo Empleado</a>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Area</th> 
                <th>Correo</th>   
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
            <tr>
                <td>{{$empleado->id}}</td>
                <td>
                    <img src="{{asset('storage').'/'.$empleado->Foto}}" alt="" width="130" class="img-fluid img-thumbnail">
                </td>
                <td>{{$empleado->Nombres}}</td>
                <td>{{$empleado->Apellidos}}</td>
                <td>{{$empleado->Area}}</td>
                <td>{{$empleado->correo}}</td>
                <td>
                    <a href="{{url('/empleado/'.$empleado->id.'/edit')}}" class="btn btn-primary">
                        Editar 
                    </a> 
                    |
                    <form action="{{url('/empleado/'.$empleado->id)}}" method="post" class="d-inline">
                        @csrf
                        {{method_field('DELETE')}}
                        <button class="btn btn-danger btn-block" onclick="return confirm('¿Quieres Borrar este Registro?')" type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $empleados->links() !!}
</div>
@endsection