@extends('Layout.app_empleado')
<link rel="stylesheet" href="assets-Internas\css\styleMesas.css">
<link rel="stylesheet" href="assets-Internas\css\styleCategorias.css">
<link rel="stylesheet" href="assets-Internas\css\mesero.css">
@section('content')

<!-- SE INCLUYE MAIN.JS PARA CORREGIR TABLA -->
{!!Html::script('javascripts\main.js')!!}

<div id="mensaje">
@include('flash::message')
</div>
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
<body class="page-header-fixed bg-1">
    <div class="modal-shiftfix">
    	<div id="page-content">
    		<div id="message">
			</div>
		<!-- inicio de las mesas-->
			<main class="cd-main-content">
				<div id="encabezado" class="cd-tab-filter-wrapper" onclick="desplegar()">
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

				<section id="mesas" class="cd-gallery desplegado">
					<ul>
						@foreach($mesas as $mesa)
							@if($mesa->estado == 'Disponible')
							<li class="mix color-1 option3" style="width: 10%">
								<a onclick="seleccionarMesa({{$mesa->id}})">
									<i class="libre"><img src="images/mesa.png"></i>
									<div class="text-Mesas">{{$mesa->nombreMesa}}</div>
								</a>  
			            	</li>
							@elseif($mesa->estado == 'Ocupada')
							<li class="mix color-2 option3" style="width: 10%">
								<a onclick="seleccionarMesa({{$mesa->id}})">
									<i class="ocupada"><img src="images/mesa.png"></i>
									<div class="text-Mesas">{{$mesa->nombreMesa}}</div>
								</a>
							</li>
							@else
							<li class="mix color-3 option3" style="width: 10%">
								<a onclick="seleccionarMesa({{$mesa->id}})">
									<i class="reservada"><img src="images/mesa.png"></i>
									<div class="text-Mesas">{{$mesa->nombreMesa}}</div>
								</a>
							</li> 
							@endif
			            @endforeach
			            
			            <!-- PARA DAR ESPACIO  NO BORRAR-->
						<li class="gap"></li>
						<li class="gap"></li>
						<li class="gap"></li>
						<li class="gap"></li>
						<li class="gap"></li>
						<li class="gap"></li>
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
					<a href="#" class="cd-close">Cerrar</a>
				</div> <!-- cd-filter -->
				<a href="#" onclick="desplegar()" class="cd-filter-trigger">Filtros</a>
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
								                	<li data-target="#basicDemo" data-slide-to="{{$key}}" class="item" onclick="actualizarCategoria({{$categoria->productos}},{{$categoria->id}})">
								                        <img id="img{{$categoria->id}}" class="grayscale categoria" src="images/categorias/{{$categoria->imagen}}">{{$categoria->nombre}}
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

<script src="assets-Internas\javascripts\mesero.js"></script>
<script src="assets-Internas\javascripts\mainMesas.js"></script>
<script src="assets-Internas\javascripts\jquery.mixitup.min.js"></script> 
</body>

@endsection