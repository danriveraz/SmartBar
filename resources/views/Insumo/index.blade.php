@extends(Auth::User()->esAdmin ? 'Layout.app_administradores' : 'Layout.app_empleado')
@section('content')
{!!Html::style('assetsNew/styles/inventario.css')!!}
<div class="modal-shiftfix">
	<div class="container main-content">
		@include('flash::message')
	<!-- DataTables Example -->
		<div class="row">
		  <div class="col-lg-12">
			<div class="widget-container fluid-height clearfix">
			  <div class="widget-content padded clearfix">
				<table class="table table-bordered table-striped" id="dataTable1">
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
					<th width="10%">
					  Disponible
					</th>
					<th width="10%">
					  Medida
					</th>
				   <th width="5%">
					  Opciones
					</th>
				  </thead>
				  <tbody>
		              @foreach($insumos as $insumo)
		                <tr id="{{$insumo->id}}">
		                  <td id="{{$insumo->id}}" class="seleccionar">{{$insumo->cantidadUnidad}}</td>
		                  <td id="{{$insumo->id}}" class="seleccionar">{{$insumo->nombre}}</td>
		                  <td id="{{$insumo->id}}" class="seleccionar">{{$insumo->marca}}</td>
		                  <td id="{{$insumo->id}}" class="seleccionar">{{$insumo->proveedor->nombre}}</td>
		                  <td id="{{$insumo->id}}" class="seleccionar">{{$insumo->valorCompra}}</td>
		                  <td id="{{$insumo->id}}" class="seleccionar">{{$insumo->precioUnidad}}</td>
		                  <td id="{{$insumo->id}}" class="seleccionar">{{number_format($insumo->cantidadMedida,3)}}</td>
		                  <td id="{{$insumo->id}}" class="seleccionar">
		                  	<span class="label label-Pocket">
		                  		<b><?php if($insumo->medida == "0"){echo "Oz";}else{echo "Unidad";} ?></b>
		                  	</span>
		                  </td>
		                  <td>
		                    <a class="table-actions pocketMorado" href=""><i class="fa fa-pencil" data-toggle="modal" href="#editModal{{$insumo->id}}" title="Editar Insumo"></i></a>
		                    <a class="table-actions pocketMorado" href="#" onclick="eliminar({{$insumo->id}})"><i class="fa fa-trash-o" title="Eliminar Insumo"></i></a>
		                  </td>
		                </tr>

		              <!--Modal para editar -->
		              <div class="modal fade" id="editModal{{$insumo->id}}">
		                <div class=" modal-body">
		                  <div class="col-lg-12" style="background-color:#FFFFFF">
		                    <div class="modal-header">
		                      <button aria-hidden="true" class=" close " data-dismiss="modal" type="button">&times;</button>
		                       <h4 class="modal-title text-center">
		                         Editar Insumo
		                       </h4>
		                      </div>
		                    <div class="modal-body">
		                    <!-- Login Screen -->
		                    <div class="row">
		                      <div class="widget-content padded">
		                        {!! Form::open() !!}
		                          <fieldset>
		                            <div class="row">
		                              <div class="col-md-4">
		                                <div class="bs-example">
		                                  	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		                                    <!-- Carousel indicators -->
			                                    <ol class="carousel-indicators">
			                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			                                        <li data-target="#myCarousel" data-slide-to="1"></li>
			                                    </ol>   
			                                    <!-- Wrapper for carousel items -->
			                                    <div class="carousel-inner">
			                                        <div class="item active">
														<img src="images/slider-admin/0.png" alt="First Slide">
													</div>
													<div class="item">
														<img src="images/slider-admin/2.png" alt="Second Slide">
													</div>
			                                    </div>
		                                    </div>
		                                  </div>
		                                </div>
		                                <div class="col-md-4 ">
		                                  <div class=" bs-example">
		                                    <div class="form-group">
		                                      <div class="input-group">
		                                        <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>
		                                        <input type="text" id="nombre{{$insumo->id}}" name="nombre" placeholder="Nombre" class="form-control" value="{{$insumo->nombre}}" required="" />
		                                      </div>
		                                    </div>
		                                    <div class="form-group">
		                                      <div class="input-group">
		                                        <span class="input-group-addon"><i class="fa fa-commenting-o"></i></span>
		                                        <input type="text" id="marca{{$insumo->id}}" name="marca" placeholder="Marca" class="form-control" value="{{$insumo->marca}}"/>
		                                      </div>
		                                    </div>
		                                    <div class="form-group">
		                                      <div class="input-group">
		                                        <span class="input-group-addon"><i class="fa fa-handshake-o"></i></span>
												<select id="proveedores{{$insumo->id}}" class="select2able">
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
		                                    <div id="divcantidad{{$insumo->id}}" class="form-group" <?php if($insumo->medida == "1") echo'style="display:none;"' ?>>
		                                      <div class="input-group">
		                                        <span id="icoCantidad" class="input-group-addon"><i class="fa fa-superscript"></i></span>
		                                        <input type="number" id="unidades{{$insumo->id}}" name="unidades{{$insumo->id}}" min="0" placeholder="Cantidad" class="form-control" value="{{$insumo->cantidadUnidad}}"/>
		                                      </div>
		                                    </div>
		                                   
		                                    <div class="form-group">
	                                    	  <label> 
			                                      <input type="checkbox" name="tipo" id="stipo{{$insumo->id}}" <?php if($insumo->tipo == "1") echo "checked";?> onchange="showContent({{$insumo->id}})" />
			                                      <span></span>
		                                      </label>
		                                      <label for="tipo" class="control-label"> Añadir a mi carta &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		                                    </div>
		                                    <div id="scontent{{$insumo->id}}" <?php if($insumo->tipo == "0") echo "hidden";?>>
		                                      <label for="categorias" class="control-label">Categor&iacutea</label>
												<select id="categoria{{$insumo->id}}" class="select2able">
													@foreach($categorias as $categoria)
														<option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
													@endforeach
												</select>
		                                    </div>
		                                  </div>
		                                </div>
		                                <div class="col-md-4">
		                                  <div class=" bs-example">
		                                  	<div class="form-group">
		                                      <div class="input-group">
		                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
		                                        <input type="number" id="compra{{$insumo->id}}" step="any" min="0" placeholder="Costo" name="valorCompra" class="form-control" value="{{$insumo->valorCompra}}" onkeyup="autocompletar(event,this,2)"/>
		                                      </div>
		                                    </div>
		                                    <div class="form-group">
		                                      <div class="input-group">
		                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
		                                        <input type="number" id="venta{{$insumo->id}}" step="any" min="0" placeholder="Venta" name="precioUnidad" class="form-control" value="{{$insumo->precioUnidad}}" onkeyup="autocompletar(event,this,3)"/>
		                                      </div>
		                                    </div>
		                                    <div class="form-group">
		                                      <div class="input-group">
		                                        <span class="input-group-addon"><i class="fa fa-eyedropper"></i></span>
		                                        <input type="number" id="cantMedida{{$insumo->id}}" min="0" step="any" placeholder="Contenido" name="cantidadMedida" class="form-control" value="{{$insumo->cantidadMedida}}"/>
		                                      </div>
		                                    </div>
		                                    <div class="form-group">
		                                      <div class="input-group">
		                                        <span class="input-group-addon"><i class="fa fa-hourglass-half"></i></span>
		                                        <select name="medida" id="medida{{$insumo->id}}" class="select2able" onchange="editValor(this.value,{{$insumo->id}});"> 
			                                        <option value="2" <?php if($insumo->medida =="2") echo "selected";?>>Mililitro</option> 
			                                        <option value="3" <?php if($insumo->medida =="3") echo "selected";?>>Cm3</option> 
			                                        <option value="0" <?php if($insumo->medida =="0") echo "selected";?>>Oz</option>
			                                        <option value="1" <?php if($insumo->medida =="1") echo "selected";?>>Unidad</option>
		                                        </select>
		                                      </div>
		                                    </div>
		                                    
		                                  </div>
		                                  <div class="text-center">
		                                    <button class="btn btn-bitbucket" data-dismiss="modal" onclick="modificar({{$insumo->id}})" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" ><i class="fa fa-send"></i>
		                                    Guardar
		                                    </button>
		                                  </div>                
		                                </div> 
		                              </div>
		                            </fieldset>
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
              <div class="heading">
                <i class="fa fa-shield"></i>&nbsp;Nuevo Producto</div>
              <div class="widget-content padded">
                {!! Form::open(['method' => 'POST', 'action' => 'InsumoController@store']) !!}
                  <fieldset>
                    <div class="row">
                      <div class="col-md-4">
                      	<div class="bs-example">
                          	<div id="myCarousel" class="carousel slide" data-ride="carousel">
                              <!-- Carousel indicators -->
	                            <ol class="carousel-indicators">
									<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
									<li data-target="#myCarousel" data-slide-to="1"></li>
								</ol>   
								<div class="carousel-inner">
									<div class="item active">
										<img src="images/slider-admin/0.png" alt="First Slide">
									</div>
									<div class="item">
										<img src="images/slider-admin/2.png" alt="Second Slide">
									</div>
								</div>
	                        </div>
                      </div>
                  </div>
                  <div class="col-md-4 ">
                    <div class=" bs-example">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>
                          <input type="text" name="nombre" class="form-control" placeholder="Nombre" placeholder="Nombre" required="true"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-commenting-o"></i></span>
                          <input type="text" name="marca" class="form-control" placeholder="Marca" placeholder="Marca"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-500px"></i></span>
                          	<select name="proveedores" class="select2able" placeholder="Proveedor" required="true">
								@foreach($proveedores as $prov)
										<option value="{{$prov->id}}">{{$prov->nombre}}</option>
								@endforeach
							</select>
                        </div>
                      </div>
                      <div id="divcantidad" class="form-group">
                        <div class="input-group">
                          <span id="iconCantidad" class="input-group-addon"><i class="fa fa-superscript"></i></span>
                          <input type="number" min="0" name="cantidadUnidad" id="cantidadUnidad" class="form-control" required="false" placeholder="Cantidad" >
                        </div>
                      </div>
                      <div class="form-group text-center">
                      	<label> 
	                        <input type="checkbox" name="tipo" id="stipo" value="1" onchange="showContent('')"/>
	                        <span></span>
                        </label>
                        <label for="tipo" class="control-label"> Añadir a la carta &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                      </div>
                      <div class="form-group">
                        <div id="scontent" style="display: none;">
                          <label for="categorias" class="control-label">Categoría</label>
                          <select name="categorias" class="select2able">
								@foreach($categorias as $categoria)
									<option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
								@endforeach
						  </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class=" bs-example">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-money"></i></span>
                          <input type="number" step="any" min="0" name="valorCompra" class="form-control" required="true" placeholder="Costo" onkeyup="autocompletar(event,this,0)">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-money"></i></span>
                          <input type="number" step="any" min="0" name="precioUnidad" class="form-control" required="true" placeholder="Venta" onkeyup="autocompletar(event,this,1)">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-eyedropper"></i></span>
                          <input type="number" step="any" min="0" id="cantidadMedida" name="cantidadMedida" placeholder="Contenido" class="form-control" required="true" />
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-hourglass-half"></i></span>
                          <select name="medida" class="select2able" onchange="valor(this.value);"> 
                            <option value="ml">Mililitro</option> 
                            <option value="cm3">Cm3</option> 
                            <option value="oz">Oz</option>
                            <option value="unidad">Unidad</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div  class="text-center">
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
  var routeModificar = "http://localhost/PocketByR/public/insumo/modificar";
  var routeEliminar = "http://localhost/PocketByR/public/insumo/eliminar";

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
      document.getElementById('divcantidad').style.display='none';
      document.getElementById('cantidadUnidad').value = 1;
      document.getElementById('cantidadMedida').placeholder ="Cantidad";
    }else{
      document.getElementById('divcantidad').style.display='block';
      document.getElementById('cantidadUnidad').value = null;
      document.getElementById('cantidadMedida').placeholder ="Contenido";
    }
  };

  var editValor = function(x,id){
    if(x == '1'){
      document.getElementById('divcantidad'+id).style.display='none';
      document.getElementById('unidades'+id).value = 1;
      document.getElementById('cantMedida'+id).placeholder ="Cantidad";
      $("#label"+id).text('Cantidad');
     }else{
      document.getElementById('divcantidad'+id).style.display='block';
      document.getElementById('unidades'+id).value = null;
      document.getElementById('cantMedida'+id).placeholder ="Contenido";
      $("#label"+id).text('Contenido');
    }
  };

  function modificar(idInsumo){
    var nombre = $("#nombre"+idInsumo).val();
    var marca = $("#marca"+idInsumo).val();
    var proveedor = $("#proveedores"+idInsumo).val();
    var nombreProveedor = $("#proveedores"+idInsumo+ " option:selected").text();
    var unidades = $("#unidades"+idInsumo).val();
    var compra = $("#compra"+idInsumo).val();
    var venta = $("#venta"+idInsumo).val();
    var cantMedida = $("#cantMedida"+idInsumo).val();
    var medida = $("#medida"+idInsumo).val();
    var check = document.getElementById("stipo"+idInsumo);
    var categoria = $("#categoria"+idInsumo).val();
    var tipo = '0';

    if(check.checked){
      tipo = '1';
    }

    if(marca==''){
      marca = 'Sin marca';
    }

    if(medida == '2' || medida == '3'){
      var cantidad = parseFloat(cantMedida)/30;
      cantMedida = cantidad;
      medida = '0';
    }
    else if(medida == '1'){
      unidades = 1;
    }
    else{
      medida = '0';
    }

    cantMedida = parseFloat(cantMedida).toFixed(3);
    
    $.ajax({
      url: routeModificar,
      type: 'GET',
      data: {
        id: idInsumo,
        nombre: nombre,
        marca: marca,
        proveedor: proveedor,
        nommbreProveedor: nombreProveedor,
        unidades: unidades,
        compra: compra,
        venta: venta,
        cantMedida: cantMedida,
        medida: medida,
        tipo: tipo,
        categoria: categoria
      },
      success: function(){       
        $("#"+idInsumo).children("td").each(function (indextd){
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
            if(medida == '0'){
              $(this).html('<span class="label label-Pocket"><b>Oz</b></span>');
            }else{
              $(this).html('<span class="label label-Pocket"><b>Unidad</b></span>');
            }
          }
        });
      },
      error: function(data){
        alert('Error al modificar insumo');
      }
    });
  }

  function eliminar(idInsumo){
    if(confirm('¿Desea eliminar este insumo?')){
      $.ajax({
        url: routeEliminar,
        type: 'GET',
        data: {
          id: idInsumo
        },
        success: function(){
            $("#"+idInsumo).remove();
        },
        error: function(data){
          alert('No se puede eliminar el insumo, porque es ingrediente de un producto.');
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