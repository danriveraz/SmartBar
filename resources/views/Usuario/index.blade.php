@extends('Layout.app')
@section('content')
<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle">
      <h1>Lista de usuarios</h1>
  </div>
  @include('flash::message')
  <a href="{{ route('auth.usuario.create') }}" class="btn btn-default"><i class="fa fa-plus"></i> Agregar nuevo usuario </a>
  <table class="table table-hover">
    <thead>
      <th>#</th>
      <th>Nombre</th>
      <th>Numero de identificación</th>
      <th>Mesero</th>
      <th>Bartender</th>
      <th>Cajero</th>
      <th>Acción</th>
    </thead>
    <tbody>
      @foreach($usuarios as $usuario)
        <tr>
          <td>{{$usuario->id}}</td>
          <td>{{$usuario->nombre}}</td>
          <td>{{$usuario->numeroIdentificacion}}</td>
          <td>
            @if($usuario->tipoMesero == 0) No
            @else Si
            @endif
          </td>
          <td>
            @if($usuario->tipoBartender == 0) No
            @else Si
            @endif
          </td>
          <td>
            @if($usuario->tipoCajero == 0) No
            @else Si
            @endif
          </td>
          <td><a href="{{ route('auth.usuario.edit',$usuario->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          <a href="{{ route('auth.usuario.destroy',$usuario->id) }}" onclick="return confirm('¿Estas seguro que deseas eliminar este usuario?')"
             class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {!!$usuarios->render() !!}
</div>
@endsection
