@extends(Auth::User()->esAdmin ? 'Layout.app_administradores' : 'Layout.app_empleado')
@section('content')
{!!Html::style('assetsNew/styles/inventario.css')!!}
<title>
  PocketSmarBar - Mi Inventario
</title>

<!-- script para activar tabla responsive-->
<script type="text/javascript" language="javascript" class="init">
$(document).ready(function() {
$('#').DataTable(
{responsive: true});
} );
</script>
<!-- script para activar tabla responsive-->

<div class="modal-shiftfix">
	<div class="container main-content">
		@include('flash::message')
	<!-- DataTables Example -->
		<div class="row">
		  <div class="col-lg-12">
			<div class="widget-container fluid-height clearfix">
			  <div class="widget-content padded clearfix">
				<table class="table table-bordered table-striped" id="example">
				  	<thead>
						<th  width="7%" align="center">
						  Und
						</th>
						<th width="15%">
						  Nombre
						</th>
						<th width="15%">
						  Marca
						</th>
						<th width="15%">
						  Proveedor
						</th>
						<th width="10%">
						  Compra
						</th>
						<th width="10%">
						  Venta
						</th>
						<th width="8%">
						  Disponible
						</th>
						<th width="8%">
						  Medida
						</th>
						<th width="10%">
						  Opciones
						</th>
					</thead>
				  	<tbody>
		              @foreach($insumos as $insumo)
		                <tr id="{{$insumo->id}}">
		                	<td id="{{$insumo->id}}">{{$insumo->cantidadUnidad}}</td>
							<td id="{{$insumo->id}}" class="seleccionar">{{$insumo->nombre}}</td>
							<td id="{{$insumo->id}}" class="seleccionar">{{$insumo->marca}}</td>
							<td id="{{$insumo->id}}" class="seleccionar">{{$insumo->proveedor->nombre}}</td>
							<td id="{{$insumo->id}}" class="seleccionar">{{$insumo->valorCompra}}</td>
							<td id="{{$insumo->id}}" class="seleccionar">{{$insumo->precioUnidad}}</td>
							<td id="{{$insumo->id}}" class="seleccionar">{{number_format($insumo->cantidadMedida,2)}}</td>
							<td id="{{$insumo->id}}" class="seleccionar">
			                  	<span class="label label-Pocket">
			                  		<b><?php if($insumo->medida == "0"){echo "Onza";}else{echo "Unidad";}?></b>
			                  	</span>
							</td>
		                  	<td>
			                    <a class="table-actions pocketMorado" href="#">
			                    	<i class="fa fa-pencil" data-toggle="modal" href="#editModal{{$insumo->id}}" title="Editar Insumo"></i>
			                    </a>
			                    <a class="table-actions pocketMorado" href="#" onclick="eliminar({{$insumo->id}})">
			                    	<i class="fa fa-trash-o" title="Eliminar Insumo"></i>
			                    </a>
								<a class="table-actions pocketMorado" href="{{route('Tienda.index')}}">
									<i class="fa fa-500px" title="Tienda"></i>
								</a>
							</td>
		                </tr>
		              <!--Modal para editar -->
		              <div class="modal fade" id="editModal{{$insumo->id}}" role="dialog">
		                <div class="modal-dialog modal-lg">
		                  <div class="modal-content" style="background-color: #FFFFFF">
		                    <div class="modal-header">
		                    	<button aria-hidden="true" class=" close " data-dismiss="modal" type="button">&times;</button>
		                       	<h4 class="modal-title text-center">
		                        	Editar Insumo
		                       	</h4>
		                    </div>
		                    <div class="modal-body">
		                    <!-- Login Screen -->
		                    <div class="row">
		                      <div class="login-form">
		                        {!! Form::open() !!}
		                            <div class="row">
		                              <div class="col-md-4">
		                                <div class="bs-example">
		                                  	<div id="myCarousel{{$insumo->id}}" class="carousel slide" data-ride="carousel">
		                                    <!-- Carousel indicators -->
			                                    <ol class="carousel-indicators">
			                                        <li data-target="#myCarousel{{$insumo->id}}" data-slide-to="0" class="active"></li>
			                                        <li data-target="#myCarousel{{$insumo->id}}" data-slide-to="1"></li>
			                                    </ol>
			                                    <!-- Wrapper for carousel items -->
			                                    <div class="carousel-inner">
			                                        <div class="item active">
														<img src="images/slider-admin/0.png" alt="First Slide" style="width: 50%;">
													</div>
													<div class="item">
														<img src="images/slider-admin/2.png" alt="Second Slide"  style="width: 50%;">
													</div>
			                                    </div>
			                                    <!-- Carousel controls -->
												<a class="carousel-control left" href="#myCarousel{{$insumo->id}}" data-slide="prev">
													<span class="glyphicon glyphicon-chevron-left"></span>
												</a>
												<a class="carousel-control right" href="#myCarousel{{$insumo->id}}" data-slide="next">
													<span class="glyphicon glyphicon-chevron-right"></span>
												</a>
		                                    </div>
		                                  </div>
		                                </div>
		                                <div class="col-md-4 ">
		                                  <div class=" bs-example">
		                                    <div id="divcantidad{{$insumo->id}}" class="form-group">
		                                      <div class="input-container">
		                                        <i class="fa fa-braille"></i>
		                                        @if($insumo->cantidadUnidad == 0)
		                                        <input type="number" id="unidades{{$insumo->id}}" name="unidades{{$insumo->id}}" min="0" placeholder="Cantidad" class="input"/>
		                                        @else
		                                        <input type="number" id="unidades{{$insumo->id}}" name="unidades{{$insumo->id}}" min="0" placeholder="Cantidad" class="input" value="{{$insumo->cantidadUnidad}}"/>
		                                        @endif
		                                      </div>
		                                    </div>
		                                    <div class="form-group">
		                                      <div class="input-container">
		                                        <i class="fa fa-book"></i>
		                                        <input type="text" id="nombre{{$insumo->id}}" name="nombre" placeholder="Nombre" class="input" value="{{$insumo->nombre}}" required="" />
		                                      </div>
		                                    </div>
		                                    <div class="form-group">
		                                      <div class="input-container">
		                                        <i class="fa fa-tags"></i>
		                                        <input type="text" id="marca{{$insumo->id}}" name="marca" placeholder="Marca" class="input" value="{{$insumo->marca}}"/>
		                                      </div>
		                                    </div>
		                                    <div class="form-group">
		                                      <div class="input-container">
		                                        <i class="fa fa-500px"></i>
												<select id="proveedores{{$insumo->id}}" class="select" style="width: 90%;">
													@foreach($proveedores as $prov)
														@if($insumo->proveedor->id == $prov->id)
															<option value="{{$prov->id}}" selected="selected">{{$prov->nombre}}</option>
														@else
															<option value="{{$prov->id}}">{{$prov->nombre}}</option>
														@endif
													@endforeach
												</select>
		                                      </div>
		                                    </div>
		                                    <div class="form-group">
		                                      <div class="input-container">
		                                        <i class="fa fa-money"></i>
		                                        @if($insumo->valorCompra == 0)
		                                        <input type="number" id="compra{{$insumo->id}}" step="any" min="0" placeholder="Costo" name="valorCompra" class="input" onkeyup="autocompletar(event,this,2)"/>
		                                        @else
		                                        <input type="number" id="compra{{$insumo->id}}" step="any" min="0" placeholder="Costo" name="valorCompra" class="input" value="{{$insumo->valorCompra}}" onkeyup="autocompletar(event,this,2)"/>
		                                        @endif
		                                      </div>
		                                    </div>
		                                    <div class="form-group">
		                                      <div class="input-container">
		                                        <i class="fa fa-handshake-o"></i>
		                                        @if($insumo->precioUnidad == 0)
		                                        <input type="number" id="venta{{$insumo->id}}" step="any" min="0" placeholder="Valor venta publico" name="precioUnidad" class="input" onkeyup="autocompletar(event,this,3)"/>
		                                        @else
		                                        <input type="number" id="venta{{$insumo->id}}" step="any" min="0" placeholder="Valor venta publico" name="precioUnidad" class="input" value="{{$insumo->precioUnidad}}" onkeyup="autocompletar(event,this,3)"/>
		                                        @endif
		                                      </div>
		                                    </div>
		                                  </div>
		                                </div>
		                                <div class="col-md-4">
		                                  <div class=" bs-example">
		                                    <div class="form-group">
		                                    	<div class="input-container">
		                                        	<i class="fa fa-stack-overflow"></i>
		                                        	@if($insumo->cantidadMedida == 0)
		                                        	<input type="number" id="cantMedida{{$insumo->id}}" min="0" step="any" placeholder="Contenido" name="cantidadMedida" class="input" <?php if($insumo->medida == "1") echo'disabled' ?> />
		                                        	@else
		                                        	<input type="number" id="cantMedida{{$insumo->id}}" min="0" step="any" placeholder="Contenido" name="cantidadMedida" class="input" value="{{$insumo->cantidadMedida}}" <?php if($insumo->medida == "1") echo'disabled' ?> />
		                                        	@endif
		                                      	</div>
		                                    </div>
		                                    <div class="form-group">
		                                        <i class="fa fa-eyedropper"></i>
		                                        <select name="medida" id="medida{{$insumo->id}}" class="select" onchange="editValor(this.value,{{$insumo->id}});">
			                                        <option value="2">Mililitro</option>
			                                        <option value="3">Cm3</option>
			                                        <option value="4">Centilitro</option>
			                                        <option value="0" <?php if($insumo->medida == "0") echo "selected";?>>Onza</option>
			                                        <option value="1" <?php if($insumo->medida == "1") echo "selected";?>>Unidad</option>
		                                        </select>
		                                    </div>
		                                    <br>
		                                    <p class="lead" style="margin-bottom: 10px;">Añade tu Producto a <span class="text-success">Mi Carta</span></p>
										  	<ul class="list-unstyled" style="line-height: 1.5">
												<li><span class="fa fa-check text-success" style="padding-right:5px;"></span>Producto para venta a publico como unidad</li>
										 	 </ul>
		                                    <div class="form-group" style="margin-left: 5%;">
	                                    	  <label>
			                                      <input type="checkbox" name="tipo" id="stipo{{$insumo->id}}" <?php if($insumo->tipo == "1") echo "checked";?> onchange="showContent({{$insumo->id}})" />
			                                      <span></span>
		                                      </label>
		                                      <label for="tipo" class="control-label"> Añadir a mi carta &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		                                    </div>
		                                    <div class="input-container" id="scontent{{$insumo->id}}" <?php if($insumo->tipo == 0) echo "hidden";?>>
												<select id="categoria{{$insumo->id}}" class="select">
													@foreach($categorias as $categoria)
														<option value="{{$categoria->id}}" <?php if($insumo->medida == "0") echo "selected";?>>{{$categoria->nombre}}</option>
													@endforeach
												</select>
		                                    </div>
		                                  </div>
		                                  <div class="form-group">
		                                    <button class="btn btn-bitbucket" data-dismiss="modal" onclick="modificar({{$insumo->id}})" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" ><i class="fa fa-send"></i>
		                                    Guardar
		                                    </button>
		                                  </div>
		                                </div>
		                              </div>
		                          {!! Form::close() !!}
		                        </div>
		                      </div>
		                      <!-- End Login Screen -->
		                    </div>
		                  </div>
		                </div>
		              </div>
		              <!-- fin de modal para editar-->
		            @endforeach
		          </tbody>
				</table>
			  </div>
			</div>
		  </div>
		</div>
	<!-- end DataTables Example -->
	</div>
</div>

<div class="style-selector" >
      <div class="style-selector-container">
    <!-- inicio de slider de agregar usuario -->
        <div class="row">
          <div class="">
            <div class="">
              <div class="widget-content padded">
                {!! Form::open(['method' => 'POST', 'action' => 'InsumoController@store', 'class' => 'login-form']) !!}
                  <fieldset>
                    <div class="row">
                      <div class="col-md-4">
                      	<div class="bs-example">
                          	<div id="myCarousel2" class="carousel slide" data-ride="carousel">
                              <!-- Carousel indicators -->
	                            <ol class="carousel-indicators">
									<li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
									<li data-target="#myCarousel2" data-slide-to="1"></li>
								</ol>
								<div class="carousel-inner">
									<div class="item active">
										<img src="images/slider-admin/0.png" alt="First Slide" style="width: 50%;">
									</div>
									<div class="item">
										<img src="images/slider-admin/2.png" alt="Second Slide"style="width: 50%;">
									</div>
								</div>
								<!-- Carousel controls -->
								<a class="carousel-control left" href="#myCarousel2" data-slide="prev">
									<span class="glyphicon glyphicon-chevron-left"></span>
								</a>
								<a class="carousel-control right" href="#myCarousel2" data-slide="next">
									<span class="glyphicon glyphicon-chevron-right"></span>
								</a>
	                        </div>
                      </div>
                  </div>
                  <div class="col-md-4 ">
                    <div class=" bs-example">
                      <div class="form-group">
                        <div class="input-container">
                          <i class="fa fa-braille"></i>
                          <input type="number" min="0" name="cantidadUnidad" id="cantidadUnidad" class="input" required placeholder="Cantidad" >
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-container">
                          <i class="fa fa-book"></i>
                          <input type="text" name="nombre" class="input" placeholder="Nombre" placeholder="Nombre" required="true"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-container">
                          <i class="fa fa-tags"></i>
                          <input type="text" name="marca" class="input" placeholder="Marca" placeholder="Marca"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-container">
                          <i class="fa fa-500px"></i>
                          	<select name="proveedores" class="select" placeholder="Proveedor" required="true" style="width: 90%;">
								@foreach($proveedores as $prov)
										<option value="{{$prov->id}}">{{$prov->nombre}}</option>
								@endforeach
							</select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-container">
                          <i class="fa fa-money"></i>
                          <input type="number" step="any" min="0" name="valorCompra" class="input" required="true" placeholder="Costo" onkeyup="autocompletar(event,this,0)">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-container">
                          <i class="fa fa-handshake-o"></i>
                          <input type="number" step="any" min="0" name="precioUnidad" class="input" required="true" placeholder="Valor venta publico" onkeyup="autocompletar(event,this,1)">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class=" bs-example">
                      <div class="form-group">
                        <div class="input-container">
                          <i class="fa fa-stack-overflow"></i>
                          <input type="number" step="any" min="0" id="cantidadMedida" name="cantidadMedida" placeholder="Contenido" class="input" required="true"/>
                        </div>
                      </div>
                      <div class="form-group">
                      	<div class="input-container">
                      		<i class="fa fa-eyedropper"></i>
                          	<select name="medida" class="select" onchange="valor(this.value);" style="width: 90%">
	                            <option value="ml">Mililitro</option>
	                            <option value="cm3">Cm3</option>
	                            <option value="cl">Centilitro</option>
	                            <option value="oz">Onza</option>
	                            <option value="unidad">Unidad</option>
	                        </select>
                        </div>
                      </div>
                      <p class="lead" style="margin-bottom: 10px;">Añade tu Producto a <span class="text-success">Mi Carta</span></p>
					  <ul class="list-unstyled" style="line-height: 1.5">
						  <li><span class="fa fa-check text-success" style="padding-right:5px;"></span>Producto para venta a publico como unidad</li>
					  </ul>
                      <div class="form-group" style="margin-left: 5%;">
                      	<label>
	                        <input  type="checkbox" name="tipo" id="stipo" value="1" onchange="showContent('')"/>
	                        <span  title="Qué es añadir a la carta?"></span>
                        </label>
                        <label  title="Qué es añadir a la carta?" for="tipo" class="control-label"> Añadir a la carta &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                      </div>
                      <div class="form-group" id="scontent" style="display: none;">
                        <div class="input-container" >
                          	<i class="fa fa-outdent"></i>
	                          	<select name="categorias" class="select" style="width: 90%;">
									@foreach($categorias as $categoria)
										<option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
									@endforeach
							  	</select>
                        </div>
                      </div>
                    </div>
                    <div  class="form-group">
                      <button class="btn btn-bitbucket" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >
                          <i class="fa fa-send"></i>Guardar
                      </button>
                    </div>
                  </div>
                </div>
              </fieldset>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
    <!-- fin de slider de agregar usuario -->
    <div class="style-toggle closed">
      <span aria-hidden="true" class="pocketMorado fa fa-fw fa-plus-circle"></span>
    </div>
  </div>
</div>

<script>
  var routeModificar = "http://localhost/SmartBar/public/insumo/modificar";
  var routeEliminar = "http://localhost/SmartBar/public/insumo/eliminar";


  $(document).ready(function(){
      cambiarCurrent("#miInventario");
      $('#example').DataTable( {
        responsive: true,
	        dom: 'lBfrtip',
	        buttons: [
	            {
	                extend:    'excelHtml5',
	                text:      '<i class="fa fa-file-excel-o"></i>',
	                titleAttr: 'Descarga Excel'
	            },
	            {
	                extend:    'pdfHtml5',
	                text:      '<i class="fa fa-file-pdf-o"></i>',
	                titleAttr: 'Descarga PDF'
	            },
	            {
	                text:      '<i class="fa fa-file-text-o" id="descargaPlantilla" name="descargaPlantilla"></i>',
	                titleAttr: 'Descarga plantilla'
	            },
	            {
	                text:      '<i class="fa fa-upload" id="subirArchivo" name="subirArchivo"></i>',
	                titleAttr: 'Subir archivo',
	                action:    function ( e, dt, node, config ) {
	                	$.ajax({
	                		url: "http://localhost/SmartBar/public/insumo/importar",
	                		type: 'GET',
	                		data: {},
	                		success: function(){
	                			alert("bien");
	                		},
	                		error: function(data){
	                			alert("mal");
	                		}
	                	});
	                }
	            }
	        ]
    	} );
    });


  function cambiarCurrent(idInput) {
    $(".current").removeClass("current");
    $(idInput).addClass("current");
  };

  function showContent(idInsumo) {
    element = document.getElementById("scontent"+idInsumo);
    check = document.getElementById("stipo"+idInsumo);
    if (check.checked) {
      element.style.display='block';
    }
    else {
      element.style.display='none';
    }
  }

  var cont = [true,true,false,false];

  function autocompletar(e,element,index){
    var valor = parseInt(e.key);
    if(valor >= 0 && valor <= 9){
      if(element.value.length != 1 && element.value != 0){
        if(cont[index]){
          var texto = parseInt(element.value)/1000;
          element.value = parseInt(((texto + valor)*1000)-valor);
        }
      }else{
        element.value = parseInt(valor*1000);
        cont[index] = true;
      }
    }else if(e.which == 8 && cont[index]){
      element.value = parseInt(element.value)/100;
      cont[index] = false;
    }
  }

  var valor = function(x){
    if(x == 'unidad'){
      document.getElementById('cantidadMedida').disabled = true;
      document.getElementById('cantidadMedida').value = 1;
    }else{
      document.getElementById('cantidadMedida').disabled = false;
    }
  };

  var editValor = function(x,id){
    if(x == '1'){
    	document.getElementById('cantMedida'+id).disabled = true;
      document.getElementById('cantMedida'+id).value = 1;
     }else{
      document.getElementById('cantMedida'+id).disabled = false;
    }
  };

  function modificar(id){
    var nombre = $("#nombre"+id).val();
    var marca = $("#marca"+id).val();
    var proveedor = $("#proveedores"+id).val();
    var nombreProveedor = $("#proveedores"+id+ " option:selected").text();
    var unidades = $("#unidades"+id).val();
    var compra = $("#compra"+id).val();
    var venta = $("#venta"+id).val();
    var cantMedida = $("#cantMedida"+id).val();
    var medida = $("#medida"+id).val();
    var check = document.getElementById("stipo"+id);
    var categoria = $("#categoria"+id).val();
    var tipo = '0';

    if(check.checked){
      tipo = '1';
    }

    if(marca==''){
      marca = 'Sin marca';
    }

    if(medida == '2' || medida == '3'){
      var cantidad = parseFloat(cantMedida)*0.033814;
      cantMedida = cantidad;
      medida = 0;
    }
    else if(medida == '4'){
      var cantidad = parseFloat(cantMedida)*0.33814;
      cantMedida = cantidad;
      medida = 0;
    }
    else if(medida == '1'){
      unidades = 1;
    }
    else{
      medida = 0;
    }

    cantMedida = parseFloat(cantMedida).toFixed(2);

    $.ajax({
      url: routeModificar,
      type: 'GET',
      data: {
        id: id,
        nombre: nombre,
        marca: marca,
        proveedor: proveedor,
        unidades: unidades,
        compra: compra,
        venta: venta,
        cantMedida: cantMedida,
        medida: medida,
        tipo: tipo,
        categoria: categoria
      },
      success: function(){
        $("#"+id).children("td").each(function (indextd){
          if(indextd == 1){
            $(this).text(nombre);
          }else if(indextd == 2){
            $(this).text(marca);
          }else if(indextd == 3){
            $(this).text(nombreProveedor);
          }else if(indextd == 0){
            $(this).text(unidades);
          }else if(indextd == 4){
            $(this).text(compra);
          }else if(indextd == 5){
            $(this).text(venta);
          }else if(indextd == 6){
            $(this).text(cantMedida);
          }else if(indextd == 7){
            if(medida == 0){
              $(this).html('<span class="label label-Pocket"><b>Onza</b></span>');
            }else{
              $(this).html('<span class="label label-Pocket"><b>Unidad</b></span>');
            }
          }
        });
      },
      error: function(data){
        alert('Ooops disculpanos, hemos tenido un error al modificar tu insumo');
      }
    });
  }

  function eliminar(id){
  	var confirmar = confirm("Es posible que el producto esté siendo utilizado como un ingrediente.\n¿Desea eliminarlo de los productos que lo utilizan?");
    if(confirmar){
      $.ajax({
        url: routeEliminar,
        type: 'GET',
        data: {
          id: id
        },
        success: function(){
            $("#"+id).remove();
            alert("Insumo eliminado exitosamente.");
        },
        error: function(data){
        	alert('Ooops disculpanos, hemos tenido un error al eliminar tu insumo');
        }
      });
    }
  }

  $(".seleccionar").click(function(){
    var idElegido = $(this).attr("id");
    var palabra = "#editModal";
    var id = palabra.concat(idElegido);
    $(id).modal();
  });
</script>


@endsection
