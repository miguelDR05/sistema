@extends('layouts.app')

@section('content')
    <div class="container">
    <!-- Envoar esta informacion -->
        <form action="{{url('/empleado')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('empleado.form',['modo'=>'Crear'])
        </form>
    </div>
@endsection
