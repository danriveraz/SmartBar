@extends('Layout.app')
@section('content')

<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle">
      <h1>Registro de insumos</h1>
  </div>
  @include('flash::message')
  {!! Form::model(Request::all(), ['route' => ['contiene.create'], 'method' => 'GET', 'class' => 'navbar-form navbar-right']) !!}
  <div class="form-group" align="right">
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placelhoder' => 'Buscar', 'aria-describedby' => 'search']) !!}
    <button type="submit" class="btn btn-dufault">Buscar</button>
    <div align="right">
      <br>
      {!! Form::select('tipo', ['' => 'Seleccione un tipo','A la venta' => 'A la venta','No a la venta' => 'No a la venta'], null, ['class' => 'form-control']) !!}
    </div>
  </div>
  {!! Form::close() !!}
  <table class="table table-hover">
    <thead>
      <th>#</th>
      <th>Nombre</th>
      <th>Tipo</th>
      <th>Cantidad de onzas</th>
    </thead>
    <tbody>
      @foreach($insumos as $insumo)
        <tr>
        <form method="POST" action="{{ route('contiene.store',['idInsumo'=>$insumo->id,'idProducto'=>$idProducto])}}">
              {{ csrf_field() }}
          <td>{{$insumo->id}}</td>
          <td>{{$insumo->nombre}}</td>
          <td>{{$insumo->tipo}}</td>
          <td><input type="number" name="cantidad" class="form-control" value="0"></td>
          <td>
              <button type="submit" class="btn btn-dufault">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              </button>
          </td>
            </form>
        </tr>
      @endforeach
    </tbody>
  </table>
  {!!$insumos->appends(Request::all())->render() !!}
</div>
@endsection