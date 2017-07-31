@extends('Layout.app')
@section('content')

<div class="col-sm-offset-3 col-sm-6"> 
  <div class="panel-tittle">
      <h1>Asignar insumos</h1>
  </div>
  <button onclick="enviarDatos({{$idProducto}})" class="btn btn-default"><i class="glyphicon glyphicon-ok"></i> Guardar</button>
  <div class="panel">
    <div class="panel-heading">
      <div class="panel-title">
        <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseOne">
          <div class="caret pull-right"></div>Insumos del producto</a>
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
                  <button type="submit" class="btn btn-dufault" onclick="eliminarInsumo({{$idProducto}},{{$contiene->idInsumo}})">
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
  <div>
    <div>
      <h3>Insumos disponibles</h3>
    </div>
    {!! Form::model(Request::all(), ['route' => ['contiene.index'], 'method' => 'GET', 'class' => 'navbar-form navbar-right']) !!}
      <div class="form-group" align="right">
        {!! Form::text('nombre', null, ['class' => 'form-control', 'placelhoder' => 'Buscar', 'aria-describedby' => 'search']) !!}
        <button type="submit" class="btn btn-dufault">Buscar</button>
        <br>
        <div align="right">
          {!! Form::select('tipo', ['' => 'Seleccione un tipo','1' => 'A la venta','0' => 'No a la venta'], null, ['class' => 'form-control']) !!}
        </div>
      </div>
    {!! Form::close() !!}
    <table class="table table-hover" id="insumosDisponibles">
      <thead>
        <th>#</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Cantidad de onzas</th>
        <th>
          <button type="submit" class="btn btn-dufault" onclick="adicionarTodo()">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"> Adicionar</span>
          </button>          
        </th>
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

{!!Html::script('javascripts\jquery.bootstrap.wizard.js')!!}
{!!Html::script('javascripts\jquery.dataTables.min.js')!!}
{!!Html::script('javascripts\jquery.easy-pie-chart.js')!!}
{!!Html::script('javascripts\jquery.sparkline.min.js')!!}
{!!Html::script('javascripts\main.js')!!}
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

  var routeEliminar = "http://localhost/PocketByR/public/contiene/eliminar";
  var routeGuardar = "http://localhost/PocketByR/public/contiene/guardar";

  function adicionarInsumo(insumo){
    var cantidad = $("#"+insumo.id).val();
    if(document.getElementById("fila"+insumo.id)!==null){
      $("#fila"+insumo.id).children("td").each(function (indextd)
        {
          if(indextd == 2){
            var nuevaCantidad = parseFloat($(this).text())+parseFloat(cantidad);
            $(this).text(nuevaCantidad);
          }
       })
    }
    else{
      var fila = '<tr id="fila'+insumo.id+'"><td>'+insumo.id+'</td><td>'+insumo.nombre+'</td><td>'+cantidad+'</td><td><button type="submit" class="btn btn-dufault" onclick="eliminarInsumo({{$idProducto}},'+insumo.id+')"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button></td></tr>';
      $("#insumoAgregados").append(fila);       
    }
    $("#"+insumo.id).val(0);
  }

  function adicionarTodo(){
    var idInsumos = [];
      var cantidades = [];
      $("table#insumosDisponibles tr").each(function() {
        $(this).children("td").each(function (indextd)
          {
            if(indextd == 0){
              idInsumos.push($(this).text());
            }else if(indextd == 2)
              cantidades.push($(this).text());
        })
      });    
    alert("bien");
  }

  function eliminarInsumo(idProducto,idInsumo){
    if(confirm('¿Desea eliminar este insumo?')){
      $.ajax({
        url: routeEliminar,
        type: 'GET',
        data: {
          idProducto: idProducto,
          idInsumo: idInsumo
        },
        success: function(){
          $("#fila"+idInsumo).remove();
        },
        error: function(data){
          alert('Error al eliminar insumo');
        }
      });
    }
  }

  function enviarDatos(idProducto){
    if(confirm('¿Desea Guardar todos los insumos agregados?')){
      var idInsumos = [];
      var cantidades = [];
      $("table#insumoAgregados tr").each(function() {
        $(this).children("td").each(function (indextd)
          {
            if(indextd == 0){
              idInsumos.push($(this).text());
            }else if(indextd == 2)
              cantidades.push($(this).text());
        })
      });
      $.ajax({
          url: routeGuardar,
          type: 'GET',
          data:{
            idProducto: idProducto,
            insumos: idInsumos,
            cantidades: cantidades
          },
          success : function() {
            document.location.href='producto';
        },
          error: function(data){
            alert('Error al adicionar insumos');
        }
      });
    }
  }  

</script>