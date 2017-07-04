@extends('Layout.app')
@section('content')

<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle">
      <h1>Lista categorías</h1>
  </div>
  @include('flash::message')
  <a href="{{ route('auth.categoria.create') }}" class="btn btn-default"><i class="fa fa-plus"></i> Agregar nueva categoría </a>

  <table class="table table-hover">
    <thead>
      <th>#</th>
      <th>Nombre</th>
    </thead>
    <tbody>
      @foreach($categorias as $categoria)
        <tr>
          <td>{{$categoria->id}}</td>
          <td>{{$categoria->nombre}}</td>

          <td><a href="{{route('auth.categoria.edit', $categoria->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          </td>
          <td><a href="{{route('auth.categoria.destroy', $categoria->id) }}" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection