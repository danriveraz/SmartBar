var idMesa = 0;
var idFactura = 0;
var route = "http://localhost/PocketByR/public/mesero/agregar";
var routeFactura = "http://localhost/PocketByR/public/mesero/factura";
var routeDisminuir = "http://localhost/PocketByR/public/mesero/disminuir";
var routeVenta = "http://localhost/PocketByR/public/mesero/venta";
var routeContiene = "http://localhost/PocketByR/public/mesero/contiene";

$(document).ready(function(){
  var estado = false;
  $('#toggle-Mesas').on('click', function(){
    $('.plegable').slideToggle();
    if (estado == true) {
      $(this).text("Abrir");
      $('body').css({
        "overflow": "auto"
      });
      estado = false;
    } else {
      $(this).text("Cerrar");
      $('body').css({
        "overflow": "hidden"
      });
      estado = true;
    }
    return false;
  });

  $('#basicDemo li:first-child').addClass('active').click();

});

cambiarCurrent("#mesero");

$('#basicDemo').carousel({
            interval: false
        });

$('#basicDemo').bind('slid', function() {
    var currentIndex = $('li.active').attr('id');
});

function desplegar(){
  var clase = $('#mesas').attr("class").split(' ');
  if(clase[1] == 'plegado'){
    $('#mesas').slideToggle(1000);
    $('#mesas').attr("class", "cd-gallery desplegado");
  }
}

function cambiarCurrent(idInput) {
  $(".current").removeClass("current");
  $(idInput).addClass("current");
};

function actualizarCategoria(productos,idCategoria){
  $('.categoria').attr('style','filter:url("data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg"><filter id="grayscale"><feColorMatrix type="matrix" values="0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0"/></filter></svg>#grayscale");filter:gray;-webkit-filter:grayscale(100%);-webkit-transition:all .1s ease;transition:all .1s ease');
  $('#img'+idCategoria).attr('style','opacity:1;filter:none;-webkit-filter:grayscale(0);-webkit-transition:all .1s ease;transition:all .1s ease');
  var table = $('#dataTable1').DataTable();
  table.clear().draw();
  for (var i = 0; i < productos.length; i++) {
    table.row.add( $('<tr><td class="hidden"></td><td onclick="actualizarTabla('+productos[i].id+',0)">'+productos[i].nombre+'</td><td onclick="actualizarTabla('+productos[i].id+',0)">'+productos[i].precio+'</td><td class="" align="center"><div><a class="table-actions pocketMorado" href="#modalReceta" title="Preparación" onclick="receta('+productos[i].id+')"><i class="fa fa-book" data-toggle="modal"></i></a><a class="table-actions pocketMorado" href="" onclick="actualizarTabla('+productos[i].id+',1)"><i class="fa fa-gift" data-toggle="modal"></i></a></div></td></tr>')).draw( false );
  }
};

function receta(productoId){
  var id = productoId;
  $.ajax({
      url: routeContiene,
      type: 'GET',
      data:{
        idP: id
      },
      success : function(data) {
        var contiene = $.parseJSON(data);
        $('#nombre').html(contiene[0].nombre);
        var cantidades = contiene[0].contiene;
        var insumos = contiene[0].insumos;
        var cadena = '';
        for (var i = 0; i < cantidades.length; i++) {
          cadena+= '<li> '+cantidades[i].cantidad+' oz de '+insumos[i].nombre+'</li>';
        }
        $('#ingredientes').html('<ul>'+cadena+'</ul>');
        $('#receta').html(contiene[0].receta);
        $('#modalReceta').modal('show');
      },
      error: function(data){
        alert('Error al consultar los insumos de un producto');
      }
  });
};


function actualizarTabla(idProducto, obsequio){
  $.ajax({
    url: route,
    type: 'GET',
    data:{
      idP: idProducto
    },
    success : function(data) {
      var producto = $.parseJSON(data);
      var table2 = $('#dataTable2').DataTable();
      if(producto != null){
          $id = producto.id;
          if(obsequio == 0){
            if($("tr#p"+$id).length){
        $cantidad = $("td#c"+ $id).html();
        $cantidadFinal = ++$cantidad;
        $precio = $("td#v"+ $id).html();
        $precioFinal = ($precio*1) + producto.precio;
        $("td#c"+ $id).replaceWith('<td id="c'+$id+'" onclick="actualizarCantidad('+$id+',0)">'+ $cantidadFinal +'</td>');
        $("td#v"+ $id).replaceWith('<td id="v'+$id+'" onclick="actualizarCantidad('+$id+',0)">'+ $precioFinal +'</td>');
            }else{
        table2.row.add( $('<tr id="p'+$id+'"><td class="hidden">'+$id+'</td><td id="c'+$id+'" onclick="actualizarCantidad('+$id+',0)">'+1+'</td><td onclick="actualizarCantidad('+$id+',0)">'+producto.nombre+'</td><td id="v'+$id+'" onclick="actualizarCantidad('+$id+',0)">'+ producto.precio+'</td><td><div><a class="table-actions pocketMorado" href="#modalReceta" onclick="receta('+$id+')"><i class="fa fa-book" data-toggle="modal" title="Preparación"></i></a></div></td></tr>')).draw( false );
            }
          }else{
            if($("tr#p"+$id+"1").length){
        $cantidad = $("td#c"+$id+"1").html();
        $cantidadFinal = ++$cantidad;
        $("td#c"+$id+"1").replaceWith('<td id="c'+$id+'1" onclick="actualizarCantidad('+$id+',1)">'+ $cantidadFinal +'</td>');
            }else{
              table2.row.add( $('<tr id="p'+$id+'1"><td class="hidden">'+$id+'</td><td id="c'+$id+'1" onclick="actualizarCantidad('+$id+',1)">'+1+'</td><td onclick="actualizarCantidad('+$id+',1)">'+producto.nombre+'</td><td id="v'+$id+'1" onclick="actualizarCantidad('+$id+',1)">Obsequio</td><td><div><a class="table-actions pocketMorado" href="#modalReceta" onclick="receta('+$id+')"><i class="fa fa-book" data-toggle="modal" title="Preparación"></i></a></div></td></tr>')).draw( false );
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

function actualizarCantidad(idProducto, obsequio){
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
      var table2 = $('#dataTable2').DataTable();
      table2.row("tr#p"+idProducto).remove().draw( false );
        }else{
          $("td#c"+ idProducto).replaceWith('<td id="c'+idProducto +'" onclick="actualizarCantidad('+idProducto+',0)">'+ cantidadFinal +'</td>');
          var precioFinal = (precio/cantidad)*cantidadFinal;
          $("td#v"+ idProducto).replaceWith('<td id="v'+idProducto +'" onclick="actualizarCantidad('+idProducto+',0)">'+ precioFinal +'</td>');
        }
     }else if(obsequio == 1){
       if(cantidadFinal == 0){
      var table2 = $('#dataTable2').DataTable();
      table2.row("tr#p"+idProducto+"1").remove().draw( false );
       }else{
         $("td#c"+ idProducto+"1").replaceWith('<td id="c'+idProducto+'1" onclick="actualizarCantidad('+idProducto+','+idFactura+',1)">'+cantidadFinal+'</td>');
       }
     }
   },
    error: function(data){
      alert('Error al disminuir la cantidad de un producto');
   }
  });

};

function seleccionarMesa(id){
  idMesa = id;
  $('#mesas').slideToggle(1000);
  $('#mesas').attr("class", "cd-gallery plegado");
  $.ajax({
    url: routeFactura,
    type: 'GET',
    data:{
      idM : idMesa
    },
    success : function(data) {
      var respuesta = $.parseJSON(data);
      idFactura = respuesta[0].idFactura;
      if(respuesta[0].validacion == true){
        var table2 = $('#dataTable2').DataTable();
        table2.clear().draw();
        var ventas = respuesta[0].ventas;
        for (var i = 0; i < ventas.length; i++) {
          $id = ventas[i].idProducto;
          if(ventas[i].obsequio == 1){
            table2.row.add( $('<tr id="p'+$id+'1"><td class="hidden">'+$id+'</td><td id="c'+$id+'1" onclick="actualizarCantidad('+$id+',1)">'+ventas[i].cantidad+'</td><td onclick="actualizarCantidad('+$id+',1)">'+ventas[i].nombre+'</td><td id="v'+$id+'1" onclick="actualizarCantidad('+$id+',1)">Obsequio</td><td><div><a class="table-actions pocketMorado" href="#modalReceta" onclick="receta('+$id+')"><i class="fa fa-book" data-toggle="modal" title="Preparación"></i></a></div></td></tr>')).draw( false );
          }else{
            table2.row.add( $('<tr id="p'+$id+'"><td class="hidden">'+$id+'</td><td id="c'+$id+'" onclick="actualizarCantidad('+$id+',0)">'+ventas[i].cantidad+'</td><td onclick="actualizarCantidad('+$id+',0)">'+ventas[i].nombre+'</td><td id="v'+$id+'" onclick="actualizarCantidad('+$id+',0)">'+ ventas[i].precio*ventas[i].cantidad+'</td><td><div><a class="table-actions pocketMorado" href="#modalReceta" onclick="receta('+$id+')"><i class="fa fa-book" data-toggle="modal" title="Preparación"></i></a></div></td></tr>')).draw( false );
          }
        }
      }
   },
    error: function(data){
      alert('Error al facturar');
   }
  });

};

function enviarDatos(){
  var idProductos = [];
  var cantidades = [];
  var totales = [];

  $("#dataTable2 tr").each(function() {
    $(this).children("td").each(function (indextd)
      {
        if(indextd == 0){
          idProductos.push($(this).text());
        }else if(indextd == 1){
          cantidades.push($(this).text());
        }else if(indextd == 3){
          if($(this).text() == 'Obsequio'){
            totales.push('1');
          }else{
            totales.push('0');
          }
        }
     })
  });

  if(idProductos == 'No hay datos disponibles en la tabla'){
    idProductos = [];
  }

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