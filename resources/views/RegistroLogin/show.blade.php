@extends('Layout.app')
@section('content')
@include('flash::message')
<h1>Ver horarios de entrada y salida del usuario</h1>
<h1>{{$usuario->nombrePersona}}</h1>
@foreach($usuario->registros as $registro)
	<p>
		{{$registro}}
	</p>
@endforeach
@endsection