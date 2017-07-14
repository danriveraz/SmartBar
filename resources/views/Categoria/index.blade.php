@extends('Layout.app')
@section('content')

<div class="col-sm-offset-2 col-sm-8">
  <div class="panel-tittle">
      <h1>Lista categorías</h1>
  </div>
  @include('flash::message')
  <a href="{{ route('categoria.create') }}" class="btn btn-default"><i class="fa fa-plus"></i> Agregar nueva categoría </a>

  <table class="table table-striped">
    <thead>
      <th>#</th>
      <th>Nombre</th>
    </thead>
    <tbody>
      @foreach($categorias as $categoria)
        <tr>
          <td>{{$categoria->id}}</td>
          <td>{{$categoria->nombre}}</td>

          <td align="right"><a href="{{route('categoria.edit', $categoria->id) }}" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          <a href="{{route('categoria.destroy', $categoria->id) }}" class="btn btn-default" onclick = "return confirm ('¿Desea eliminar esta categoría?')" style="BACKGROUND-COLOR: rgb(187,187,187); color:white"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
          </td>

        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection