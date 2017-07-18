@extends('Layout.app')
@section('content')

<div class="col-sm-offset-2 col-sm-8">
  <div class="panel-tittle">
      <h1>Asignar insumos</h1>
  </div>
  @include('flash::message')
  <a href="{{ route('contiene.index') }}" class="btn btn-default"><i class="fa fa-plus"></i> Modificar contenido</a>
  <div>
    <div class="col-sm-5">
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
              <td><a href="{{ route('contiene.destroy', ['idInsumo'=>$contiene->idInsumo]) }}" class="btn btn-default"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="col-sm-7">
      {!! Form::model(Request::all(), ['route' => ['contiene.index'], 'method' => 'GET', 'class' => 'navbar-form navbar-right']) !!}
      <div class="form-group" align="right">
        {!! Form::text('nombre', null, ['class' => 'form-control', 'placelhoder' => 'Buscar', 'aria-describedby' => 'search']) !!}
        <button type="submit" class="btn btn-dufault">Buscar</button>
        <div align="right">
          <br>
          {!! Form::select('tipo', ['' => 'Seleccione un tipo','1' => 'A la venta','0' => 'No a la venta'], null, ['class' => 'form-control']) !!}
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
            @foreach($insumosDisponibles as $insumo)
            <tr>
              <form method="POST" action="{{ route('contiene.store',['idInsumo'=>$insumo->id])}}">
                {{ csrf_field() }}
                <td>{{$insumo->id}}</td>
                <td>{{$insumo->nombre}}</td>
                <td align="center">
                  <input type="checkbox" disabled="disabled" name="tipo" id="tipo" <?php if($insumo->tipo == "1") echo "checked";?>/>
                </td>
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
        {!!$insumosDisponibles->appends(Request::all())->render() !!}
      </div>
    </div>
  </div>
@endsection