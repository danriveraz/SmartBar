@extends('Layout.app')
@section('content')

<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle">
      <h1>Asignar insumos</h1>
  </div>
  @include('flash::message')
  <a href="{{route('producto.index')}}" class="btn btn-default"><i class="fa fa-plus"></i>Guardar contenido</a>
  <div>
    <div>
      <div class="panel">
        <div class="panel-heading">
          <div class="panel-title">
            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseOne">
              <div class="caret pull-right"></div>
              Insumos del producto</a>
          </div>
        </div>
        <div class="panel-collapse collapse" id="collapseOne">
          <div class="panel-body">
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
                  <td><a href="{{ route('contiene.destroy', $contiene->id) }}" class="btn btn-default"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div>
      <div>
        <h3>Insumos disponibles</h3>
      </div>
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
          <th><a href="{{route('producto.index')}}" class="btn btn-default"><i class="fa fa-plus"></i>Adicionar insumos</a></th>
        </thead>
        <tbody>
          @foreach($insumosDisponibles as $insumo)
          <tr>
            <form method="POST" action="{{route('contiene.store',['idInsumo'=>$insumo->id])}}">
              {{ csrf_field() }}
              <td>{{$insumo->id}}</td>
              <td>{{$insumo->nombre}}</td>
              <td align="center">
                <input type="checkbox" disabled="disabled" name="tipo" id="tipo" <?php if($insumo->tipo == "1") echo "checked";?>/>
              </td>
              <td><input type="number" step="any" min="0" name="cantidad" class="form-control" value="{{$contador++}}"></td>
              <td align="center">
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