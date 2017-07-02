@extends('Layout.app')
@section('content')

<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle">
      <h1>Lista de productos</h1>
  </div>
  @include('flash::message')
  <a href="{{ route('producto.create') }}" class="btn btn-default"><i class="fa fa-plus"></i> Agregar nuevo producto </a>
  {!! Form::model(Request::all(), ['route' => ['producto.index'], 'method' => 'GET', 'class' => 'navbar-form navbar-right']) !!}
  <div class="form-group" align="right">
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placelhoder' => 'Buscar', 'aria-describedby' => 'search']) !!}
    <button type="submit" class="btn btn-dufault">Buscar</button>
    <div align="right">
      <br>
      <select >
        <option>Seleccione una categoría</option>
      </select>
    </div>
  </div>
  {!! Form::close() !!}
  <table class="table table-hover">
    <thead>
      <th>#</th>
      <th>Nombre</th>
      <th>Tipo</th>
    </thead>
    <tbody>
      @foreach($productos as $producto)
        <tr>
          <td>{{$producto->idProducto}}</td>
          <td>{{$producto->nombre}}</td>
          <td>{{$producto->tipo}}</td>
          <td><a href="{{ route('producto.edit',$producto->idProducto) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {!!$productos->appends(Request::all())->render() !!}
</div>
@endsection