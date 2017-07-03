@extends('Layout.app')
@section('content')

<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle">
    <h1>Lista de insumos</h1>
  <div>
    <h3>Insumos registrados</h3>
  </div>
  @include('flash::message')
  {!! Form::model(Request::all(), ['route' => ['auth.contiene.create'], 'method' => 'GET', 'class' => 'navbar-form navbar-right']) !!}
  <div class="form-group" align="right">
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placelhoder' => 'Buscar', 'aria-describedby' => 'search']) !!}
    <button type="submit" class="btn btn-dufault">Buscar</button>
    <div align="right">
      <br>
      {!! Form::select('tipo', ['' => 'Seleccione un tipo','cerveza' => 'Cerveza','licor' => 'Licor'], null, ['class' => 'form-control']) !!}
    </div>
  </div>
  {!! Form::close() !!}
  <table class="table table-hover">
    <thead>
      <th>#</th>
      <th>Nombre</th>
      <th>Cantidad de unidades (oz)</th>
    </thead>
    <tbody>
      @foreach($insumos as $insumo)
        <tr>
          <td>{{$insumo->id}}</td>
          <td>{{$insumo->nombre}}</td>
          <td>
            <div class="form-grup">
              <input type="number" value="0" name="cantidadUnidad" class="form-control">
            </div>
          </td>
          <td>
            {!! Form::model(Request::all(), ['route' => ['auth.contiene.store',$insumo->id], 'method' => 'GET', 'class' => 'navbar-form navbar-right']) !!}
            <button type="submit" class="btn btn-warning">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </button>
            {!! Form::close() !!}
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {!!$insumos->appends(Request::all())->render() !!}
</div>
@endsection