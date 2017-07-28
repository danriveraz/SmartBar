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
            <table class="table table-hover" id="insumoAgregados">
              <thead>
                <th>#</th>
                <th>Insumo</th>
                <th>Cantidad de onzas</th>
              </thead>
              <tbody>
                @foreach($contienen as $contiene)
                <tr id="fila{{$contiene->idInsumo}}">
                  <td>{{$contiene->idInsumo}}</td>
                  <td>{{$insumos[$contiene->idInsumo]}}</td>
                  <td>{{$contiene->cantidad}}</td>
                  <td>
                    <button type="submit" class="btn btn-dufault" onclick="removerInsumo({{$contiene->idInsumo}},{{$contiene->cantidad}})">
                      <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                    </button>
                  </td>
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
      <table class="table table-hover" >
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
              <td>{{$insumo->id}}</td>
              <td>{{$insumo->nombre}}</td>
              <td align="center">
                <input type="checkbox" disabled="disabled" name="tipo" id="tipo" <?php if($insumo->tipo == "1") echo "checked";?>/>
              </td>
              <td><input type="number"  id="{{$insumo->id}}" step="any" min="0" name="cantidad" class="form-control" value=0></td>
              <td align="center">
                <button type="submit" class="btn btn-dufault" onclick="adicionarInsumo({{$insumo}})">
                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {!!$insumosDisponibles->appends(Request::all())->render() !!}
    </div>
  </div>
</div>
@endsection

<script>

  var routeAgregar = "http://localhost/PocketByR/public/contiene/agregar";
  var routeEliminar = "http://localhost/PocketByR/public/contiene/eliminar";

  function adicionarInsumo(insumo){
    var cantidad = $("#"+insumo.id).val();
    $.ajax({
      url: routeAgregar,
      type: 'GET',
      data: {idI: insumo.id,
             cant: cantidad},
      success: function(data){
        var fila = '<tr id="fila'+insumo.id+'"><td>'+insumo.id+'</td><td>'+insumo.nombre+'</td><td>'+cantidad+'</td><td><button type="submit" class="btn btn-dufault" onclick="removerInsumo('+insumo.id+','+cantidad+')"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button></td></tr>';
        $("#insumoAgregados").append(fila);
      },
      error : function(data){
        alert('Error al adicionar el insumo');
      }
    });    
  }

  function removerInsumo(id,cantidad){
    var fila = $("#fila"+id);
    $.ajax({
      url: routeEliminar,
      type: 'GET',
      data: {idI: id,
             cant: cantidad},
      success: function(data){
        $("#fila"+id).remove();
      },
      error : function(data){
        alert('Error al remover el insumo');
      }
    });    
  }

</script>