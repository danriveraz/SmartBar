@extends('Layout.app')
@section('content')

<div class="col-sm-offset-2 col-sm-8">
  <div class="panel-tittle">
      <h1>Lista de proveedores</h1>
  </div>
  @include('flash::message')
  <a href="{{ route('proveedor.create') }}" class="btn btn-default"><i class="fa fa-plus"></i> Agregar nuevo proveedor </a>
  {!! Form::model(Request::all(), ['route' => ['proveedor.index'], 'method' => 'GET', 'class' => 'navbar-form navbar-right']) !!}
  <div class="form-group" align="right">
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placelhoder' => 'Buscar', 'aria-describedby' => 'search']) !!}
   <button type="submit" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" class="btn btn-dufault">Buscar</button>
  </div>
  {!! Form::close() !!}
  <table class="table table-striped">
    <thead>
      <th>#</th>
      <th>Nombre</th>
      <th>Dirección</th>
      <th>Telefono</th>
    </thead>
    <tbody>
      @foreach($proveedores as $proveedor)
        <tr>
          <td>{{$proveedor->id}}</td>
          <td>{{$proveedor->nombre}}</td>
          <td>{{$proveedor->direccion}}</td>
          <td>{{$proveedor->telefono}}</td>
          <td align="right"><a href="{{ route('proveedor.edit',$proveedor->id) }}" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          <a href="{{route('proveedor.destroy', $proveedor->id) }}" class="btn btn-default" onclick = "return confirm ('¿Desea eliminar este proveedor?')" style="BACKGROUND-COLOR: rgb(187,187,187); color:white"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>

          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {!!$proveedores->appends(Request::all())->render() !!}
</div>
@endsection