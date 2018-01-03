$(document).ready(function(){
  $("#contenedorCategorias a:first-child")[0].click();
  cambiarCurrent("#mesero");
});

function cambiarCurrent(idInput) {
  $(".current").removeClass("current");
  $(idInput).addClass("current");
};

function scrollZero(){
  $('#tablaProductos tbody').scrollTop(0);
};

var route = "http://localhost/PocketByR/public/mesero/agregar";
var routeDisminuir = "http://localhost/PocketByR/public/mesero/disminuir";
var routeVenta = "http://localhost/PocketByR/public/mesero/venta";

function actualizarTabla(idProducto, idFactura, obsequio){
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
              $("td#c"+ producto.id).replaceWith('<td id="c'+producto.id +'" onclick="actualizarCantidad('+$id+','+idFactura+',0)">'+ cantidadFinal +'</td>');
              $("td#t"+ producto.id).replaceWith('<td id="t'+producto.id +'" onclick="actualizarCantidad('+$id+','+idFactura+',0)">'+ cantidadFinal* producto.precio +'</td>');
            }else{
              $('#pedidoTabla > tbody').append('<tr id="p'+producto.id+'"><td style="display: none;">'+producto.id
              +'</td><td id="c'+producto.id +'" onclick="actualizarCantidad('+$id+','+idFactura+',0)">'+ 1
              +'</td><td onclick="actualizarCantidad('+$id+','+idFactura+',0)">'+producto.nombre+'</td><td id="v'+producto.id+'" onclick="actualizarCantidad('+$id+','+idFactura+',0)">'+ producto.precio
              +'</td><td id="t'+ producto.id+'" onclick="actualizarCantidad('+$id+','+idFactura+',0)">'+ producto.precio + '</td></tr>');
            }
          }else{
            if($("tr#p"+$id+"1").length){
              var cantidad = $("td#c"+ producto.id + "1").html();
              var cantidadFinal = ++cantidad;
              $("td#c"+ producto.id + "1").replaceWith('<td id="c'+producto.id +'1" onclick="actualizarCantidad('+$id+','+idFactura+',1)">'+ cantidadFinal +'</td>');
            }else{
              $('#pedidoTabla > tbody').append('<tr id="p'+producto.id+'1"><td style="display: none;">'+producto.id
              +'</td><td id="c'+producto.id +'1" onclick="actualizarCantidad('+$id+','+idFactura+',1)">'+ 1
              +'</td><td onclick="actualizarCantidad('+$id+','+idFactura+',1)">'+producto.nombre+'</td><td id="v'+producto.id+'1" onclick="actualizarCantidad('+$id+','+idFactura+',1)">'+ producto.precio
              +'</td><td id="t'+ producto.id+'1" onclick="actualizarCantidad('+$id+','+idFactura+',1)">Obsequio</td></tr>');
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
          $("td#c"+ idProducto).replaceWith('<td id="c'+idProducto +'" onclick="actualizarCantidad('+idProducto+','+idFactura+',0)">'+ cantidadFinal +'</td>');
          $("td#t"+ idProducto).replaceWith('<td id="t'+idProducto +'" onclick="actualizarCantidad('+idProducto+','+idFactura+',0)">'+ cantidadFinal*precio +'</td>');
        }
     }else if(obsequio == 1){
       if(cantidadFinal == 0){
         $("tr#p"+idProducto+"1").remove();
       }else{
         $("td#c"+ idProducto+"1").replaceWith('<td id="c'+idProducto +'1" onclick="actualizarCantidad('+idProducto+','+idFactura+',1)">'+ cantidadFinal +'</td>');
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
          window.location = "http://localhost/PocketByR/public/mesero";
        }else{
          $( "#message" ).load(window.location.href + " #message" );
        }
     },
      error: function(data){
        alert('Error al guardar en venta');
     }
   });
};
