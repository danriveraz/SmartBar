@extends('Layout.app_empleado')
@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://cdn.bootcss.com/animate.css/3.5.1/animate.min.css">
{!!Html::style('stylesheets\mesero.css')!!}


<div class="col-sm-offset-2 col-sm-8">

  <a href="{{ route('mesero.index') }}" id="botonAtras" class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Atras</a>

  <div class="panel-tittle" align="center" style ="text-transform: uppercase;">
      <h3><B>{{$mesa->nombreMesa}}</B></h3>
  </div>

  <div id="message">
    @if(Session::has('error_msg'))
      <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{Session::get('error_msg')}}
      </div>
    @endif
   </div>

  <div class="bs-example" id="contenedor" style="height: calc({{sizeOf($categorias)}} * 68px);">
      <div class="widget-container scrollable" id="contenedorCategorias">
        <div class="widget-content" id="scrollContent">
          @foreach($categorias as $categoria)
          <a data-toggle="tab" href="#tabProductos{{$categoria->id}}" >
            <div id="categoria">
                  {{$categoria->nombre}}
            </div>
          </a>
          @endforeach
        </div>
      </div>
      <div class="widget-container scrollable" id="contenedorProductos">
        <div class="widget-content" id="scrollContent">
          <div class="tab-content" id="productos">
            @foreach($categorias as $categoria)
              <div class="tab-pane" id="tabProductos{{$categoria->id}}">
                <table class="table table-striped" id="tablaProductos">
                  <thead>
                    @if($obsequiar == 1)
                    <th width="40%">Nombre</th>
          					<th width="20%">Detalles</th>
          					<th width="20%">Valor unitario</th>
                    <th width="10%">Obsequiar</th>
                    @else
                    <th width="40%">Nombre</th>
          					<th width="20%">Detalles</th>
          					<th width="20%">Valor unitario</th>
                    <th style="display: none;">Obsequiar</th>
                    @endif
                   </thead>
                  <tbody>
                    @foreach($categoria->productos as $producto)
                      <tr>
                        <td onclick="actualizarTabla({{$producto->id}},{{$factura->id}}, 0)">{{$producto->nombre}}</td>
                        <td>
                          <a class="btn btn btn-primary popover-trigger" data-html="true" data-content=
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
                        <td onclick="actualizarTabla({{$producto->id}},{{$factura->id}}, 0)">{{$producto->precio}}</td>
                        @if($obsequiar == 1)
                        <td>
                          <button class="btn btn-info" onclick="actualizarTabla({{$producto->id}},{{$factura->id}}, 1)" >
                            <span class="glyphicon glyphicon-gift"></span>
                          </button>
                        </td>
                        @else
                        <td>
                          <button class="btn btn-info" onclick="actualizarTabla({{$producto->id}},{{$factura->id}}, 1)" style="display: none;">
                            <span class="glyphicon glyphicon-gift"></span>
                          </button>
                        </td>
                        @endif
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @endforeach
          </div>
        </div>
      </div>
  </div>

  <div class="panel-tittle" align="center" style ="text-transform: uppercase;">
      <h3><B>Pedido</B></h3>
  </div>

  @if(sizeOf($ventas) != 0)
    <table class="table table-bordered" id="pedidoTabla" style="display: table; margin-top: 10px; margin-bottom: 30px;">
        <thead>
          <th style="display: none;">#</th>
          <th width="20px" style="display: none;">Cant.</th>
          <th width="150px" style="display: none;">Nombre</th>
          <th width="50px" style="display: none;">Valor unitario</th>
          <th width="100px" style="display: none;">Total</th>
          <th width="20px" style="display: none;">Eliminar</th>
        </thead>
        <tbody>

            @foreach($ventas as $venta)
              @if($venta->obsequio == 0)
                <tr id="p{{$venta->producto->id}}">
                  <td style="display: none;">{{$venta->producto->id}}</td>
                  <td id="c{{$venta->producto->id}}">{{$venta->cantidad}}</td>
                  <td>{{$venta->producto->nombre}}</td>
                  <td id="v{{$venta->producto->id}}">{{$venta->producto->precio}}</td>
                  <td id="t{{$venta->producto->id}}">{{$venta->producto->precio * $venta->cantidad}}</td>
                  <td><button class="btn btn-danger" onclick="actualizarCantidad({{$venta->producto->id}},{{$factura->id}},{{$venta->obsequio}})" ><span class="glyphicon glyphicon-minus"></span></button></td>
                </tr>
              @else
                <tr id="p{{$venta->producto->id}}1">
                  <td style="display: none;">{{$venta->producto->id}}</td>
                  <td id="c{{$venta->producto->id}}1">{{$venta->cantidad}}</td>
                  <td>{{$venta->producto->nombre}}</td>
                  <td id="v{{$venta->producto->id}}1">{{$venta->producto->precio}}</td>
                  <td id="t{{$venta->producto->id}}1">Obsequio</td>
                  <td><button class="btn btn-danger" onclick="actualizarCantidad({{$venta->producto->id}},{{$factura->id}},{{$venta->obsequio}})" ><span class="glyphicon glyphicon-minus"></span></button></td>
                </tr>
              @endif
            @endforeach
        </tbody>
    </table>
  @else
    <table class="table table-bordered" id="pedidoTabla" style="display: none; margin-top: 10px; margin-bottom: 30px;">
        <thead>
          <th style="display: none;">#</th>
          <th width="20px" style="display: none;">Cant.</th>
          <th width="150px" style="display: none;">Nombre</th>
          <th width="50px" style="display: none;">Valor unitario</th>
          <th width="100px" style="display: none;">Total</th>
          <th width="20px" style="display: none;">Eliminar</th>
        </thead>
        <tbody>
        </tbody>
    </table>
  @endif

  <button onclick="enviarDatos({{$factura->id}}, {{$mesa->id}})" id="botonEnviar" class="btn btn-default"><i class="glyphicon glyphicon-ok"></i> Ordenar</button>

</div>

{!!Html::script('javascripts\jquery.bootstrap.wizard.js')!!}
{!!Html::script('javascripts\jquery.dataTables.min.js')!!}
{!!Html::script('javascripts\jquery.easy-pie-chart.js')!!}
{!!Html::script('javascripts\jquery.sparkline.min.js')!!}

@endsection

<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript" src="project.js"></script>
<script>

  $(document).ready(function(){
      $("#scrollContent a:first-child").click();
      cambiarCurrent("#mesero");
  });

  function cambiarCurrent(idInput) {
    $(".current").removeClass("current");
    $(idInput).addClass("current");
  };

  var route = "http://pocketdesigner.co/PocketByR/public/mesero/agregar";
  var routeDisminuir = "http://pocketdesigner.co/PocketByR/public/mesero/disminuir";
  var routeVenta = "http://pocketdesigner.co/PocketByR/public/mesero/venta";



  function actualizarTabla(idProducto, idFactura, obsequio){
    if(confirm('¿Desea agregar este producto al pedido?')){
      $('#pedidoTabla').css({'display': 'table', 'margin-top': '10px' , 'margin-bottom': '30px'});
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
              if(obsequio == 0){
                if($("tr#p"+$id).length){
                  $id = producto.id;
                  var cantidad = $("td#c"+ producto.id).html();
                  var cantidadFinal = ++cantidad;
                  $("td#c"+ producto.id).replaceWith('<td id="c'+producto.id +'">'+ cantidadFinal +'</td>');
                  $("td#t"+ producto.id).replaceWith('<td id="t'+producto.id +'">'+ cantidadFinal* producto.precio +'</td>');
                }else{
                  $('#pedidoTabla > tbody').append('<tr id="p'+producto.id+'"><td style="display: none;">'+producto.id
                  +'</td><td id="c'+producto.id +'">'+ 1 +'</td><td>'+producto.nombre+'</td><td id="v'+producto.id+'">'+ producto.precio+'</td><td id="t'+ producto.id+'">'+ producto.precio + '</td><td>'+
                  '<button class="btn btn-danger" onclick="actualizarCantidad('+$id+','+idFactura+',0)"><span class="glyphicon glyphicon-minus"></span></button>'
                  +'</td></tr>');
                }
              }else{
                if($("tr#p"+$id+"1").length){
                  var cantidad = $("td#c"+ producto.id + "1").html();
                  var cantidadFinal = ++cantidad;
                  $("td#c"+ producto.id + "1").replaceWith('<td id="c'+producto.id +'1">'+ cantidadFinal +'</td>');
                }else{
                  $('#pedidoTabla > tbody').append('<tr id="p'+producto.id+'1"><td style="display: none;">'+producto.id
                  +'</td><td id="c'+producto.id +'1">'+ 1 +'</td><td>'+producto.nombre+'</td><td id="v'+producto.id+'1">'+ producto.precio+'</td><td id="t'+ producto.id+'1">Obsequio</td><td>'+
                  '<button class="btn btn-danger" onclick="actualizarCantidad('+$id+','+idFactura+',1)"><span class="glyphicon glyphicon-minus"></span></button>'
                  +'</td></tr>');
                }

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
 };

  function actualizarCantidad(idProducto, idFactura, obsequio){
    if(obsequio == 0){
      var cantidad = $("td#c"+ idProducto).html();
      var cantidadFinal = cantidad - 1;
      var precio = $("td#v"+ idProducto).html();
    }else{
      var cantidad = $("td#c"+ idProducto+"1").html();
      var cantidadFinal = cantidad - 1;
      var precio = $("td#v"+ idProducto+"1").html();
    }

    $.ajax({
      url: routeDisminuir,
      type: 'GET',
      data:{
        idP: idProducto,
        idF : idFactura,
        cant : cantidadFinal,
        obsequiar: obsequio
      },
      success : function() {
        if(obsequio == 0){
          if(cantidadFinal == 0){
            $("tr#p"+idProducto).remove();
          }else{
            $("td#c"+ idProducto).replaceWith('<td id="c'+idProducto +'">'+ cantidadFinal +'</td>');
            $("td#t"+ idProducto).replaceWith('<td id="t'+idProducto +'">'+ cantidadFinal*precio +'</td>');
          }
       }else if(obsequio == 1){
         if(cantidadFinal == 0){
           $("tr#p"+idProducto+"1").remove();
         }else{
           $("td#c"+ idProducto+"1").replaceWith('<td id="c'+idProducto +'1">'+ cantidadFinal +'</td>');
         }
       }
     },
      error: function(data){
        alert('Error al disminuir la cantidad de un producto');
     }
    });

  };

  function enviarDatos(idFactura, idMesa){
    var idProductos = [];
    var cantidades = [];
    var totales = [];

    $("table#pedidoTabla tr").each(function() {
      $(this).children("td").each(function (indextd)
        {
          if(indextd == 0){
            idProductos.push($(this).text());
          }else if(indextd == 1){
            cantidades.push($(this).text());
          }else if(indextd == 4){
            if($(this).text() == 'Obsequio'){
              totales.push('1');
            }else{
              totales.push('0');
            }
          }
       })
    })

    $.ajax({
        url: routeVenta,
        type: 'GET',
        data:{
          productosTabla: idProductos,
          cantidadesTabla: cantidades,
          totalesTabla: totales,
          factura: idFactura,
          mesa: idMesa
        },
        success : function() {
          if(idProductos.length != 0){
            window.location = "http://pocketdesigner.co/PocketByR/public/mesero";
          }else{
            $( "#message" ).load(window.location.href + " #message" );
          }
       },
        error: function(data){
          alert('Error al guardar en venta');
       }
     });
  };

</script>
