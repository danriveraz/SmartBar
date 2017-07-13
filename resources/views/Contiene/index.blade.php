@extends('Layout.app')
@section('content')

<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle">
      <h1>Asignar insumos</h1>
  </div>
  @include('flash::message')
  <a href="{{ route('contiene.create', ['idProducto'=>$idProducto]) }}" class="btn btn-default"><i class="fa fa-plus"></i> Ingresar nuevo insumo </a>
  <table class="table table-hover">
    <thead>
      <th>#</th>
      <th>Insumo</th>
      <th>Cantidad de onzas</th>
    </thead>
    <tbody>
      @foreach($contienen as $contiene)
        <tr>
          <td>{{$contiene->idInsumo}}</td>
          <td>{{$insumos[$contiene->idInsumo]}}</td>
          <td>{{$contiene->cantidad}}</td>
          <td><a href="" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection