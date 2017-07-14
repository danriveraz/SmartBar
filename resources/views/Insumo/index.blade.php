@extends('Layout.app')
@section('content')

<div class="col-sm-offset-2 col-sm-8">
  <div class="panel-tittle">
      <h1>Lista de insumos</h1>
  </div>
  @include('flash::message')
  <a href="{{ route('insumo.create') }}" class="btn btn-default"><i class="fa fa-plus"></i> Agregar nuevo insumo </a>
  {!! Form::model(Request::all(), ['route' => ['insumo.index'], 'method' => 'GET', 'class' => 'navbar-form navbar-right']) !!}
  <div class="form-group" align="right">
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placelhoder' => 'Buscar', 'aria-describedby' => 'search']) !!}
    <button type="submit" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" class="btn btn-dufault">Buscar</button>
    <div align="right">
      <br>
      {!! Form::select('tipo', ['' => 'Seleccione un tipo','A la venta' => 'A la venta','No a la venta' => 'No a la venta'], null, ['class' => 'form-control']) !!}
    </div>
  </div>
  {!! Form::close() !!}
  <table class="table table-striped">
    <thead>
      <th>#</th>
      <th>Nombre</th>
      <th>Marca</th>
      <th>Proveedor</th>
      <th>Cantidad de unidad</th>
      <th>Valor venta</th>
      <th>Valor compra</th>
      <th>(oz)</th>
      <th>Tipo</th>
    </thead>
    <tbody>
      @foreach($insumos as $insumo)
        <tr>
          <td>{{$insumo->id}}</td>
          <td>{{$insumo->nombre}}</td>
          <td>{{$insumo->marca}}</td>
          <td>{{$proveedores[$insumo->idProveedor]}}</td>
          <td>{{$insumo->cantidadUnidad}}</td>
          <td>{{$insumo->precioUnidad}}</td>
          <td>{{$insumo->valorCompra}}</td>
          <td>{{number_format($insumo->cantidadMedida,3)}}</td>
          <td>{{$insumo->tipo}}</td>
          <td align="right"><a href="{{ route('insumo.edit',$insumo->id) }}" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          <a href="{{route('insumo.destroy', $insumo->id) }}" class="btn btn-default" onclick = "return confirm ('¿Desea eliminar este insumo?')" style="BACKGROUND-COLOR: rgb(187,187,187); color:white"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {!!$insumos->appends(Request::all())->render() !!}
</div>
@endsection