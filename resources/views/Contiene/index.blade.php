@extends('Layout.app')
@section('content')

<div class="col-sm-offset-2 col-sm-8"> 
  <div class="panel-tittle" align="center">
      <h3><b>{{$nombre}}<b></h3>
  </div>
  <div class="panel">
    <div class="panel-heading">
      <div class="panel-title">
        <a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapseOne">
          <div class="caret pull-right"></div>Insumos del producto</a>
      </div>
    </div>
    <div class="panel-collapse collapse in" id="collapseOne">
      <div class="panel-body">
        <table class="table table-hover" id="insumoAgregados">
          <thead>
            <th style="display: none;">#</th>
            <th>Insumo</th>
            <th>Cantidad de onzas/unidades</th>
          </thead>
          <tbody>
            @foreach($contienen as $contiene)
              <tr id="fila{{$contiene->idInsumo}}">
                <td style="display: none;">{{$contiene->idInsumo}}</td>
                <td>{{$insumos[$contiene->idInsumo]}}</td>
                <td>{{$contiene->cantidad}}</td>
                <td>
                  <button type="submit" class="btn btn-dufault" onclick="eliminarInsumo({{$idProducto}},{{$contiene->idInsumo}})" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
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
    <form id="busqueda" name="busqueda" class="navbar-form navbar-right" method="GET" 
    route="contiene.listall">
    {{csrf_field()}}
      <div class="form-group" align="right">
        <input  id="nombreInput" type="text" name="nombreInput" class="form-control" aria-describedby="search"/>
        <button  href="contlistall?nombre=" id="buscarNombre" type="submit" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" class="btn btn-dufault">Buscar</button>
        <div align="right">
        <select id="buscarTipo" name="buscarTipo" class="form-control">
          <option value="">Seleccione un tipo</option>
          <option value="1">A la venta</option> 
          <option value="0">No a la venta</option>   
        </select>
      </div>
      </div>
    </form>
    <div class="panel-body">
      <div id="list-cont"></div>
   </div>
   <div align="right">
     <button onclick="enviarDatos({{$idProducto}})" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><i class="glyphicon glyphicon-ok"></i> Guardar</button>
   </div>
  </div>
</div>


@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">

  $(document).ready(function(){
    listprov();
  });

  $(document).on("click", '#buscarNombre',function(e){
    e.preventDefault();
    var dato = $("#nombreInput").val();
    var tipo = $("#buscarTipo").val();
    var url = $(this).attr("href");
    var urlf = url+dato+'&tipo='+tipo;
    $.ajax({
      type:'get',
      url:urlf,
      success: function(data){
        $("#list-cont").empty().html(data);
      }
    });
  });

  $(document).on("click",".pagination li a",function(e){
    e.preventDefault();
    var url = $(this).attr("href");
    $.ajax({
      type:'get',
      url:url,
      success: function(data){
        $("#list-cont").empty().html(data);
      }
    });
  });

  var listprov = function()
  {
    $.ajax({
      type:'get',
      url: '{{url('contlistall')}}',
      success:  function(data){
        $('#list-cont').empty().html(data);
      }
    });
  }

</script>
<script>

  var routeEliminar = "http://pocketdesigner.co/PocketByR/public/contiene/eliminar";
  var routeGuardar = "http://pocketdesigner.co/PocketByR/public/contiene/guardar";

  function tecla(e,insumo){
    if(e.which == 13){
      adicionarInsumo(insumo);
    }
  }

  function adicionarInsumo(insumo){
    var cantidad = $("#"+insumo.id).val();
    var medida = $("#medida"+insumo.id).val();
    if(medida == 2 || medida == 3){
      var cantidadAux = cantidad/30;
      cantidad = cantidadAux;
    }
    if(cantidad>0){
      if(document.getElementById("fila"+insumo.id)!=null){
        $("#fila"+insumo.id).children("td").each(function (indextd)
          {
            if(indextd == 2){
              var nuevaCantidad = parseFloat($(this).text())+parseFloat(cantidad);
              $(this).text(nuevaCantidad);
            }
          });
        }
      else{
        var fila = '<tr id="fila'+insumo.id+'"><td style="display: none;">'+insumo.id+'</td><td>'+insumo.nombre+'</td><td>'+cantidad+'</td><td><button type="submit" class="btn btn-dufault" onclick="eliminarInsumo({{$idProducto}},'+insumo.id+')" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>';
        $("#insumoAgregados").append(fila);       
      }
      $("#"+insumo.id).val('');
      $("#medida"+insumo.id).val(insumo.medida);
    }
  }

  function modificarInsumo(insumo){
    var cantidad = $("#"+insumo.id).val();
    var medida = $("#medida"+insumo.id).val();
    if(medida == 2 || medida == 3){
      var cantidadAux = cantidad/30;
      cantidad = cantidadAux;
    }
    if(cantidad>0){
      if(document.getElementById("fila"+insumo.id)!=null){
        $("#fila"+insumo.id).children("td").each(function (indextd)
          {
            if(indextd == 2){
              $(this).text(cantidad);
            }
          });
        }
      $("#"+insumo.id).val('');
      $("#medida"+insumo.id).val(insumo.medida);
    }
  }  

  function adicionarTodo(){
    var insumos = [];
    var nombres = [];
      $("table#insumosDisponibles tr").each(function() {
        $(this).children("td").each(function (indextd)
          {
            if(indextd == 0){
              insumos.push($(this).text());
            }else if(indextd == 1){
              nombres.push($(this).text());
            }
        })
      });
      for(var i = 0; i < insumos.length; i++){
        var cantidad = $("#"+insumos[i]).val();
        var medida = $("#medida"+insumos[i]).val();
        if(medida == 2 || medida == 3){
          var cantidadAux = cantidad/30;
          cantidad = cantidadAux;
        }        
        if(cantidad != 0){
          if(document.getElementById("fila"+insumos[i])!=null){
            $("#fila"+insumos[i]).children("td").each(function (indextd)
            {
              if(indextd == 2){
                var nuevaCantidad = parseFloat($(this).text())+parseFloat(cantidad);
                $(this).text(nuevaCantidad);
              }
            });            
          }
          else{
            var fila = '<tr id="fila'+insumos[i]+'"><td  style="display: none;">'+insumos[i]+'</td><td>'+nombres[i]+'</td><td>'+cantidad+'</td><td><button type="submit" class="btn btn-dufault" onclick="eliminarInsumo({{$idProducto}},'+insumos[i]+')" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>';
            $("#insumoAgregados").append(fila);
          }
          $("#"+insumos[i]).val('');
          $("#medida"+insumos[i]).val(insumos[i].medida);
        }
      }
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