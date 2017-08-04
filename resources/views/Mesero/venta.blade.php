@extends('Layout.app_empleado')
@section('content')

{!!Html::style('stylesheets\mesero.css')!!}

<div class="col-sm-offset-2 col-sm-8">

  <a href="{{ route('mesero.index') }}" id="botonAtras" class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Atras</a>

  <div id="message">
    @if(Session::has('error_msg'))
      <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{Session::get('error_msg')}}
      </div>
    @endif
   </div>

  <div class="bs-example">
      <div class="panel-group" id="accordion">
        @foreach($categorias as $categoria)
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h4 class="panel-title">
                      <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href={{"#collapse".$categoria->id}}><div class="caret pull-right"></div>
                        {{$categoria->nombre}}</a>
                  </h4>
              </div>
              <div id={{"collapse".$categoria->id}} class="panel-collapse collapse">
                  <div class="panel-body">
                    <table class="table table-striped" id="tablaProductos">
                      <thead>
                        <th width="30px">#</th>
                        <th width="200px">Nombre</th>
                        <th width="30px">Detalles</th>
                        <th width="30px">Valor unitario</th>
                        <th width="20px">Agregar</th>
                      </thead>
                      <tbody>
                    @foreach($categoria->productos as $producto)
                      <tr>
                        <td>{{$producto->id}}</td>
                        <td>{{$producto->nombre}}</td>
                        <td>
                          <a class="btn btn btn-default popover-trigger" data-html="true" data-content=
                          "<div>
                            <strong>Ingredientes:</strong>
                            @foreach($producto->contienen as $contiene)
                              <li>{{$contiene->insumo->nombre}}</li>
                            @endforeach
                            <strong>Receta:</strong>
                            <p>{{$producto->receta}}</p>
                          </div>"
                          data-placement="bottom" data-toggle="popover">Receta</a>
                        </td>
                        <td>{{$producto->precio}}</td>
                        <td>
                          <button class="btn btn-success" onclick="actualizarTabla({{$producto->id}},{{$factura->id}})" >
                            <span class="glyphicon glyphicon-plus"></span>
                          </button>
                        </td>
                      </tr>
                    @endforeach

                  </tbody>
                  </table>
                  </div>
              </div>
          </div>
        @endforeach
      </div>
  </div>

  <table class="table table-bordered" id="pedidoTabla" style="margin-top: 40px; margin-bottom: 40px;">
    <thead>
      <th width="50px">#</th>
      <th width="150px">Nombre</th>
      <th width="50px">Valor unitario</th>
      <th width="20px">Cant.</th>
      <th width="100px">Total</th>
      <th width="20px">Eliminar</th>
    </thead>
    <tbody>
      @if($ventas != null)
        @foreach($ventas as $venta)
        <tr id="p{{$venta->producto->id}}">
          <td>{{$venta->producto->id}}</td>
          <td>{{$venta->producto->nombre}}</td>
          <td id="v{{$venta->producto->id}}">{{$venta->producto->precio}}</td>
          <td id="c{{$venta->producto->id}}">{{$venta->cantidad}}</td>
          <td id="t{{$venta->producto->id}}">{{$venta->producto->precio * $venta->cantidad}}</td>
          <td><button class="btn btn-danger" onclick="actualizarCantidad({{$venta->producto->id}},{{$factura->id}})" ><span class="glyphicon glyphicon-minus"></span></button></td>
        </tr>
        @endforeach
      @endif
    </tbody>
  </table>

  <button onclick="enviarDatos({{$factura->id}}, {{$mesa->id}})" id="botonEnviar" class="btn btn-default"><i class="glyphicon glyphicon-ok"></i> Guardar pedido</button>

</div>

{!!Html::script('javascripts\jquery.bootstrap.wizard.js')!!}
{!!Html::script('javascripts\jquery.dataTables.min.js')!!}
{!!Html::script('javascripts\jquery.easy-pie-chart.js')!!}
{!!Html::script('javascripts\jquery.sparkline.min.js')!!}
{!!Html::script('javascripts\main.js')!!}

@endsection

<script>
  var route = "http://localhost/PocketByR/public/mesero/agregar";
  var routeDisminuir = "http://localhost/PocketByR/public/mesero/disminuir";
  var routeVenta = "http://localhost/PocketByR/public/mesero/venta";

  $(function(){
    $("#accordion").accordion({
      collapsible: true
    });
  } );

  function actualizarTabla(idProducto, idFactura){
    $.ajax({
      url: route,
      type: 'GET',
      data:{
        idP: idProducto,
        idF: idFactura
      },
      success : function(data) {
         var producto = $.parseJSON(data);
         if(producto != null){
            $id = producto.id;
            if($("tr#p"+$id).length){
              $id = producto.id;
              var cantidad = $("td#c"+ producto.id).html();
              var cantidadFinal = ++cantidad;
              $("td#c"+ producto.id).replaceWith('<td id="c'+producto.id +'">'+ cantidadFinal +'</td>');
              $("td#t"+ producto.id).replaceWith('<td id="t'+producto.id +'">'+ cantidadFinal* producto.precio +'</td>');
            }else{
              $('#pedidoTabla > tbody').append('<tr id="p'+producto.id+'"><td>'+producto.id
              +'</td><td>'+producto.nombre+'</td><td id="v'+producto.id+'">'+ producto.precio+'</td><td id="c'+producto.id +'">'+ 1
              +'</td><td id="t'+ producto.id+'">'+ producto.precio + '</td><td>'+
              '<button class="btn btn-danger" onclick="actualizarCantidad('+$id+','+idFactura+')"><span class="glyphicon glyphicon-minus"></span></button>'
              +'</td></tr>');
            }
         }else{
           $( "#message" ).load(window.location.href + " #message" );
         }
     },
      error: function(data){
        alert('Error al aumentar la cantidad de un producto');
     }
    });
  }

  function actualizarCantidad(idProducto, idFactura){
    var cantidad = $("td#c"+ idProducto).html();
    var cantidadFinal = cantidad - 1;
    var precio = $("td#v"+ idProducto).html();

    $.ajax({
      url: routeDisminuir,
      type: 'GET',
      data:{
        idP: idProducto,
        idF : idFactura,
        cant : cantidadFinal
      },
      success : function() {
         if(cantidadFinal == 0){
           var row = document.getElementById("p"+idProducto);
           row.parentNode.removeChild(row);
         }else{
           $("td#c"+ idProducto).replaceWith('<td id="c'+idProducto +'">'+ cantidadFinal +'</td>');
           $("td#t"+ idProducto).replaceWith('<td id="t'+idProducto +'">'+ cantidadFinal*precio +'</td>');
         }
     },
      error: function(data){
        alert('Error al disminuir la cantidad de un producto');
     }
    });

  }

  function enviarDatos(idFactura, idMesa){
    var idProductos = [];
    var cantidades = [];
    $("table#pedidoTabla tr").each(function() {
      $(this).children("td").each(function (indextd)
        {
          if(indextd == 0){
            idProductos.push($(this).text());
          }else if(indextd == 3)
            cantidades.push($(this).text());
       })
    });

    $.ajax({
        url: routeVenta,
        type: 'GET',
        data:{
          productosTabla: idProductos,
          cantidadesTabla: cantidades,
          factura: idFactura,
          mesa: idMesa
        },
        success : function() {
          if(idProductos.length != 0){
            window.location = "http://localhost/PocketByR/public/mesero";
          }else{
            $( "#message" ).load(window.location.href + " #message" );
          }
       },
        error: function(data){
          alert('Error al guardar en venta');
       }
     });
  }
</script>
