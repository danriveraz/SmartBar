@extends('Layout.app')
@section('content')
<h1>Hola {{Auth::user()->nombrePersona}}</h1>
@endsection