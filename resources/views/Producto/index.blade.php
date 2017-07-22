@extends('Layout.app')
@section('content')
<div class="col-sm-offset-2 col-sm-8">
    <div class="panel-tittle">
        <h1>Lista de productos</h1>
    </div>
    @include('flash::message')
    <a href="{{ route('producto.create') }}" class="btn btn-default"><i class="fa fa-plus"></i> Agregar nuevo producto </a>
    {!! Form::model(Request::all(), ['route' => ['producto.index'], 'method' => 'GET', 'class' => 'navbar-form navbar-right']) !!}
    <div class="form-group" align="right">
      {!! Form::text('nombre', null, ['class' => 'form-control', 'placelhoder' => 'Buscar', 'aria-describedby' => 'search']) !!}
      <button type="submit" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" class="btn btn-dufault">Buscar</button>

    <div align="right">
      <br>
      {!! Form::select('categorias', $categorias, null, ['class' => 'form-control']) !!}
       <td><a href="{{ route('categoria.create') }}" class="btn btn-default" style="BACKGROUND-COLOR: rgb(187,187,187); color:white"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></td>
      <td><a href="{{ route('categoria.index') }}" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a></td>
    </div>
  </div>
  {!! Form::close() !!}
  <table class="table table-striped">
    <thead>
      <th>#</th>
      <th>Nombre</th>
      <th>Precio</th>
      <th>Categoria</th>
    </thead>
    <tbody>
      @foreach($productos as $producto)
        <tr>
          <td>{{$producto->id}}</td>
          <td>{{$producto->nombre}}</td>
          <td>{{$producto->precio}}</td>
          <td>{{$categorias[$producto->idCategoria]}}</td>
          <td align="right"><a href="{{ route('producto.edit',$producto->id) }}" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          </td>
          <td align="right"><a href="{{ route('producto.insumoedit',$producto->id) }}" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">Insumos <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {!!$productos->appends(Request::all())->render() !!}
</div>
@endsection