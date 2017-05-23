@extends('Layout.app')
@section('content')
<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle">
      <h1>Lista de insumos</h1>
  </div>
  @include('flash::message')
  <a href="{{ route('insumo.create') }}" class="btn btn-default"><i class="fa fa-plus"></i> Agregar nuevo insumo </a>
  <table class="table table-hover">
    <thead>
      <th>#</th>
      <th>Nombre</th>
      <th>Proveedor</th>
      <th>Cantidad de unidades</th>
      <th>Valor de venta</th>
      <th>>Valor de compra</th>
      <th>Cantidad de medida</th>
      <th>Tipo</th>
      <th>Categoria</th>
    </thead>
    <tbody>
      @foreach($insumos as $insumo)
        <tr>
          <td>{{$insumo->id}}</td>
          <td>{{$insumo->nombre}}</td>
          <td>{{$insumo->idProveedor}}</td>
          <td>{{$insumo->cantidadUnidad}}</td>
          <td>{{$insumo->precioUnidad}}</td>
          <td>{{$insumo->valorCompra}}</td>
          <td>{{$insumo->cantidadMedida}}</td>
          <td>{{$insumo->tipo}}</td>
          <td>{{$insumo->categoria}}</td>
          <td><a href="{{ route('insumo.edit',$insumo->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {!!$insumos->render() !!}
</div>
@endsection