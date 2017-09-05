@extends('Layout.app_proveedores')
@section('content')
@include('flash::message')
<h1>Modulo de los usuarios de proveedores </h1>
<h1>Hola {{Auth::user()->nombrePersona}}</h1>
@endsection