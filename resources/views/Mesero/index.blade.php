@extends('Layout.app_empleado')
<link rel="stylesheet" href="stylesheets/styleMesas.css">
<link rel="stylesheet" href="stylesheets/styleCategorias.css">
@section('content')
<style>
	.plegable {
		width: 100%;
		overflow: hidden;
		display: none;
	}

	.btn-toggle {
		height: 50px;
		line-height: 50px;
		font-size: 24px;
		font-weight: bold;
		color: #000;
		display: block;
		text-align: center;
		background: #FFDC00; 
	}

	.btn-toggle:hover {
		text-decoration: none; 
	}

	#botonEnviar{
		margin-right: 50px;
		margin-bottom: 45px;
	}
	#message{
		margin-right: 10%;
		margin-left: 10%;
		text-align: center;
	}
</style>
<body class="page-header-fixed bg-1">
    <div class="modal-shiftfix">
    	<div id="page-content">
    		<div id="message">
				@if(Session::has('error_msg'))
					<div class="alert alert-danger alert-dismissable">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  {{Session::get('error_msg')}}
					</div>
				@elseif(Session::has('success_msg'))
					<div class="alert alert-success alert-dismissable">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  {{Session::get('success_msg')}}
					</div>
				@endif
			</div>
		<!-- inicio de las mesas-->
			<main id="mesas" class="cd-main-content">
				<div class="cd-tab-filter-wrapper">
					<div class="cd-tab-filter">
						<ul class="cd-filters">
							<li class="placeholder"> 
								<a data-type="all" href="">Todas</a> <!-- selected option on mobile -->
							</li> 
							<li class="filter"><a class="selected" href="#" data-type="all">Todas</a></li>
							<li class="filter" data-filter=".color-1"><a href="#" data-type="color-1">Libres</a></li>
							<li class="filter" data-filter=".color-2"><a href="#" data-type="color-2">Ocupadas</a></li>
							<li class="filter" data-filter=".color-3"><a href="#" data-type="color-3">Reservadas</a></li>
						</ul> <!-- cd-filters -->
					</div> <!-- cd-tab-filter -->
				</div> <!-- cd-tab-filter-wrapper -->

				<!-- color- es para el estado de la mesa-->

				<section class="cd-gallery">
					<ul>
						@foreach($mesas as $mesa)
							@if($mesa->estado == 'Disponible')
							<li class="mix color-1 option3">
								<a onclick="seleccionarMesa({{$mesa->id}})">
									<i class="libre"><img src="images/mesa.png"></i>
									<div class="text-Mesas">{{$mesa->nombreMesa}}</div>
								</a>  
			            	</li>
							@elseif($mesa->estado == 'Ocupada')
							<li class="mix color-2 option3">
								<a onclick="seleccionarMesa({{$mesa->id}})">
									<i class="ocupada"><img src="images/mesa.png"></i>
									<div class="text-Mesas">{{$mesa->nombreMesa}}</div>
								</a>
							</li>
							@else
							<li class="mix color-3 option3">
								<a onclick="seleccionarMesa({{$mesa->id}})">
									<i class="reservada"><img src="images/mesa.png"></i>
									<div class="text-Mesas">{{$mesa->nombreMesa}}</div>
								</a>
							</li> 
							@endif
			            @endforeach
			            
			            <!-- PARA DAR ESPACIO  NO BORRAR-->
						<li class="gap"></li>
						<!-- PARA DAR ESPACIO NO BORRAR-->

					</ul>
					<div class="cd-fail-message">No se han encontrado resultados</div>
				</section> <!-- cd-gallery -->
			   
				<!--<a href="#" id="toggle-Mesas" class="btn-toggle">Abrir</a>-->

				<!-- Inicio del filtro-->
				<div class="cd-filter">
					<form>
						<div class="cd-filter-block">
							<h4>Buscar</h4>
							
							<div class="cd-filter-content">
								<input type="search" placeholder="Numero mesa...">
							</div> <!-- cd-filter-content -->
						</div> <!-- cd-filter-block -->
					</form>
					<a href="#0" class="cd-close">Cerrar</a>
				</div> <!-- cd-filter -->
				<a href="#0" class="cd-filter-trigger">Filtros</a>
			<!-- fin del filtro-->
			</main>            
		<!-- fin del mesas-->


			<div class="container main-content">
				<div class="row">
					<div align="center" style="align-content:center">
						<section class="btCustomCarousel">
							<div class="container">
								<div id="basicDemo" class="carousel slide" data-ride="carousel">
								    <div class="row">
								        <div class="col-md-12 col-sm-12">
								            <ol style="text-align:center; list-style-position:inside;" class="carousel-indicators">
								            	@foreach($categorias as $key => $categoria)
								                	<li id="{{$categoria->id}}" data-target="#basicDemo" data-slide-to="{{$key}}" class="item" onclick="actualizarCategoria({{$categoria->productos}})">
								                        <i class="fa fa-fw fa-star"></i>{{$categoria->nombre}}
								                    </li>
								            	@endforeach
								            </ol>
								        </div>
								    </div>
								</div>
							</div>
						</section>
					</div>
				</div>
			</div>
      

			<div class="row">
				<div class="col-lg-6">
					<div class="widget-container fluid-height clearfix">
						<div class="widget-content padded clearfix">
							<table class="table table-bordered table-striped" id="dataTable1">
								<thead>
									<th class="hidden"></th>
									<th width="50%">
									  Nombre
									</th>
									<th width="45%">
									  Precio($)
									</th>
									<th width="5%" align="center">
									  Opciones
									</th>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			  
				<div class="col-lg-6">
					<div class="widget-container fluid-height clearfix">
						<div class="widget-content padded clearfix">
							<table class="table table-bordered table-striped" id="dataTable2">
								<thead>
									<th class="hidden"></th>
									<th width="12%">
									  Cant
									</th>
									<th width="43%">
									  Nombre
									</th>
									<th width="30%">
									  Precio($)
									</th>
									<th width="15%">
									  Opciones
									</th>
								</thead>
								<tbody>              
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<button onclick="enviarDatos()" id="botonEnviar" class="btn btn-bitbucket pull-right"><i class="glyphicon glyphicon-ok"></i> Ordenar</button>
		</div>
  	</div>
	<div class="modal fade" id="modalReceta">
		<div class="dialog1 modal-dialog">
			<div class="col-lg-12" style="background-color:#FFFFFF">
				<div class="modal-header">
				  <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
				  <h4 class="modal-title text-center">Preparación</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="widget-content ">
							<form action="" id="validate-form" method="get">
								<fieldset>
									<div class="row">
										<div class="col-md-12">
											<div class=" bs-example">
												<h3><a id="nombre" class="pocketMorado"></a></h3>
												<div class="true" id="ingredientes">
												</div>
												<div><br>
													<strong><a class="pocketMorado">Elaboración</a></strong><br>
													<p id="receta" style="text-align: justify;"></p><br>
												</div>
											</div>
										</div>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- script del desplegable-->
<script>

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

$('#basicDemo').carousel({
            interval: false
        });

$('#basicDemo').bind('slid', function() {
    var currentIndex = $('li.active').attr('id');
   	
});

function actualizarCategoria(productos){
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

</script>      
               
   <!-- cd-main-content de mesas 
<script src="javascripts/mesas/jquery-2.1.1.js"></script>-->
<script src="javascripts/jquery.mixitup.min.js"></script>
<script src="javascripts/mainMesas.js"></script> <!-- Resource jQuery -->    
</body>

@endsection