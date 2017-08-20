@extends('Layout.app_empleado')
@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://cdn.bootcss.com/animate.css/3.5.1/animate.min.css">
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

  <div class="bs-example" id="contenedor">
      <div class="widget-container scrollable" id="contenedorCategorias">
        <div class="widget-content" id="scrollContent">
          @foreach($categorias as $categoria)
          <a data-toggle="tab" href="#tabProductos{{$categoria->id}}">
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
                    <th width="40%">Nombre</th>
          					<th width="20%">Detalles</th>
          					<th width="20%">Valor unitario</th>
          					<th width="10%">Agregar</th>
                    <th width="10%">Obsequiar</th>
                   </thead>
                  <tbody>
                    @foreach($categoria->productos as $producto)
                      <tr>
                        <td>{{$producto->nombre}}</td>
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
                        <td>{{$producto->precio}}</td>
                        <td>
                          <button class="btn btn-success" onclick="actualizarTabla({{$producto->id}},{{$factura->id}}, 0)" >
                            <span class="glyphicon glyphicon-plus"></span>
                          </button>
                        </td>
                        <td>
                          @if($obsequiar == 1)
                          <button class="btn btn-info" onclick="actualizarTabla({{$producto->id}},{{$factura->id}}, 1)" >
                            <span class="glyphicon glyphicon-gift"></span>
                          </button>
                          @else
                          <button class="btn btn-default" onclick="actualizarTabla({{$producto->id}},{{$factura->id}}, 1)" disabled>
                            <span class="glyphicon glyphicon-gift"></span>
                          </button>
                          @endif
                        </td>
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

  @if(sizeOf($ventas) != 0)
    <table class="table table-bordered" id="pedidoTabla" style="display: table; margin-top: 10px; margin-bottom: 40px;">
        <thead>
          <th style="display: none;">#</th>
          <th width="150px">Nombre</th>
          <th width="50px">Valor unitario</th>
          <th width="20px">Cant.</th>
          <th width="100px">Total</th>
          <th width="20px">Eliminar</th>
        </thead>
        <tbody>

            @foreach($ventas as $venta)
              @if($venta->obsequio == 0)
                <tr id="p{{$venta->producto->id}}">
                  <td style="display: none;">{{$venta->producto->id}}</td>
                  <td>{{$venta->producto->nombre}}</td>
                  <td id="v{{$venta->producto->id}}">{{$venta->producto->precio}}</td>
                  <td id="c{{$venta->producto->id}}">{{$venta->cantidad}}</td>
                  <td id="t{{$venta->producto->id}}">{{$venta->producto->precio * $venta->cantidad}}</td>
                  <td><button class="btn btn-danger" onclick="actualizarCantidad({{$venta->producto->id}},{{$factura->id}},{{$venta->obsequio}})" ><span class="glyphicon glyphicon-minus"></span></button></td>
                </tr>
              @else
                <tr id="p{{$venta->producto->id}}1">
                  <td style="display: none;">{{$venta->producto->id}}</td>
                  <td>{{$venta->producto->nombre}}</td>
                  <td id="v{{$venta->producto->id}}1">{{$venta->producto->precio}}</td>
                  <td id="c{{$venta->producto->id}}1">{{$venta->cantidad}}</td>
                  <td id="t{{$venta->producto->id}}1">Obsequio</td>
                  <td><button class="btn btn-danger" onclick="actualizarCantidad({{$venta->producto->id}},{{$factura->id}},{{$venta->obsequio}})" ><span class="glyphicon glyphicon-minus"></span></button></td>
                </tr>
              @endif
            @endforeach
        </tbody>
    </table>
  @else
    <table class="table table-bordered" id="pedidoTabla" style="display: none; margin-top: 10px; margin-bottom: 40px;">
        <thead>
          <th style="display: none;">#</th>
          <th width="150px">Nombre</th>
          <th width="50px">Valor unitario</th>
          <th width="20px">Cant.</th>
          <th width="100px">Total</th>
          <th width="20px">Eliminar</th>
        </thead>
        <tbody>
        </tbody>
    </table>
  @endif

  <button onclick="enviarDatos({{$factura->id}}, {{$mesa->id}})" id="botonEnviar" class="btn btn-default"><i class="glyphicon glyphicon-ok"></i> Guardar pedido</button>

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

  var route = "http://localhost/PocketByR/public/mesero/agregar";
  var routeDisminuir = "http://localhost/PocketByR/public/mesero/disminuir";
  var routeVenta = "http://localhost/PocketByR/public/mesero/venta";

  function actualizarTabla(idProducto, idFactura, obsequio){
    $('#pedidoTabla').css({'display': 'table', 'margin-top': '10px' , 'margin-bottom': '40px'});
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
                +'</td><td>'+producto.nombre+'</td><td id="v'+producto.id+'">'+ producto.precio+'</td><td id="c'+producto.id +'">'+ 1
                +'</td><td id="t'+ producto.id+'">'+ producto.precio + '</td><td>'+
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
                +'</td><td>'+producto.nombre+'</td><td id="v'+producto.id+'1">'+ producto.precio+'</td><td id="c'+producto.id +'1">'+ 1
                +'</td><td id="t'+ producto.id+'1">Obsequio</td><td>'+
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

  function actualizarCantidad(idProducto, idFactura, obsequio){
    if(obsequio == 0){
      var cantidad = $("td#c"+ idProducto).html();
      var cantidadFinal = --cantidad;
      var precio = $("td#v"+ idProducto).html();
    }else{
      var cantidad = $("td#c"+ idProducto+"1").html();
      var cantidadFinal = --cantidad;
      var precio = $("td#v"+ idProducto+"1").html();
    }

    $.ajax({
      url: routeDisminuir,
      type: 'GET',
      data:{
        idP: idProducto,
        idF : idFactura,
        cant : cantidadFinal
      },
      success : function() {
        if(obsequio == 0){
          if(cantidadFinal == 0){
            $("tr#p"+idProducto).remove();
          }else{
            $("td#c"+ idProducto).replaceWith('<td id="c'+idProducto +'">'+ cantidadFinal +'</td>');
            $("td#t"+ idProducto).replaceWith('<td id="t'+idProducto +'">'+ cantidadFinal*precio +'</td>');
          }
       }else{
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

  }

  function enviarDatos(idFactura, idMesa){
    var idProductos = [];
    var cantidades = [];
    var totales = [];
    $("table#pedidoTabla tr").each(function() {
      $(this).children("td").each(function (indextd)
        {
          if(indextd == 0){
            idProductos.push($(this).text());
          }else if(indextd == 3){
            cantidades.push($(this).text());
          }else if(indextd == 4){
            if($(this).text() == 'Obsequio'){
              totales.push('1');
            }else{
              totales.push('0');
            }
          }
       })
    });

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
