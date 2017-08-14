@extends('Layout.app')
@section('content')
<h1>Hola {{Auth::user()->nombrePersona}}</h1>
<h2>Puede regalar: {{Auth::user()->obsequio}}</h2>
@endsection