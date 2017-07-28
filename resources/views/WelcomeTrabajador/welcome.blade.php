@extends('Layout.app_empleado')
@section('content')
@include('flash::message')
<h1>Hola {{Auth::user()->nombrePersona}}</h1>
@endsection