@extends('Layout.app')
@section('content')

{!!Html::style('stylesheets/mesero.css')!!}

<div class="col-sm-offset-2 col-sm-8">
  <div id="message">
  @if(Session::has('error_msg'))
      <div class="alert alert-dismissable alert-danger">
  			<button aria-hidden="true" data-dismiss="alert" class="close" type="button">
          <i class="glyphicon glyphicon-danger"></i>×</button>
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
                      <a data-toggle="collapse" data-parent="#accordion" href={{"#collapse".$categoria->id}}>{{$categoria->nombre}}</a>
                  </h4>
              </div>
              <div id={{"collapse".$categoria->id}} class="panel-collapse collapse">
                  <div class="panel-body">
                    <table class="table table-striped" id="tablaProductos">
                      <thead>
                        <th width="30px">#</th>
                        <th width="250px">Nombre</th>
                        <th width="30px"> Valor unitario</th>
                        <th width="20px">Agregar</th>
                      </thead>
                      <tbody>
                    @foreach($categoria->productos as $producto)
                      <tr>
                        <td>{{$producto->id}}</td>
                        <td>{{$producto->nombre}}</td>
                        <td>{{$producto->precio}}</td>
                        <td>
                          <button class="btn btn-success" onclick="actualizarTabla({{$producto->id}})" >
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
    </tbody>
  </table>


  @foreach($facturas as $factura)
  <button onclick="enviarDatos({{$factura->id}})" id="botonEnviar" class="btn btn-default"><i class="fa fa-plus"></i>Enviar pedido</button>
  @endforeach
</div>

@endsection

<script>
var route = "http://localhost/PocketByR/public/mesero/agregar";
var routeDisminuir = "http://localhost/PocketByR/public/mesero/disminuir";
var routeVenta = "http://localhost/PocketByR/public/mesero/venta";

$(function() {
  $("#accordion").accordion({
    collapsible: true
  });
} );

function actualizarTabla(e){
  $.ajax({
    url: route,
    type: 'GET',
    data:{
      idP: e
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
            '<button class="btn btn-danger" onclick="actualizarCantidad('+$id+')"><span class="glyphicon glyphicon-minus"></span></button>'
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

function actualizarCantidad(id){

  var cantidad = $("td#c"+ id).html();
  var cantidadFinal = cantidad - 1;
  var precio = $("td#v"+ id).html();

  $.ajax({
    url: routeDisminuir,
    type: 'GET',
    data:{
      idP: id
    },
    success : function() {
       if(cantidadFinal == 0){
         var row = document.getElementById("p"+id);
         row.parentNode.removeChild(row);
       }else{
         $("td#c"+ id).replaceWith('<td id="c'+id +'">'+ cantidadFinal +'</td>');
         $("td#t"+ id).replaceWith('<td id="t'+id +'">'+ cantidadFinal*precio +'</td>');
       }
   },
    error: function(data){
      alert('Error al disminuir la cantidad de un producto');
   }
  });

}

function enviarDatos(idFactura){
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

  if(idProductos.length != 0){
    $.ajax({
        url: routeVenta,
        type: 'GET',
        data:{
          productosTabla: idProductos,
          cantidadesTabla: cantidades,
          factura: idFactura
        },
        success : function() {
          window.location = "http://localhost/PocketByR/public/mesero";
       },
        error: function(data){
          alert('Error al guardar en venta');
       }
     })
  }else{
    alert('Debe agregar productos');
  }
}
</script>
