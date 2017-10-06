

<script src="javascripts\jquery.dataTables.js" type="text/javascript"></script>
<script src="javascripts\main2.js" type="text/javascript"></script>
<script src="javascripts\respond.js" type="text/javascript"></script>


<div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
      <div class="widget-content padded clearfix">
        <table class="table table-bordered table-striped" id="dataTable1">
            <thead>
              <th width="7%" align="center">Und</th>
              <th width="15%">Nombre</th>
              <th width="15%">Marca</th>
              <th width="15%">Proveedor</th>
              <th width="10%">Compra</th>
              <th width="10%">Venta</th>
              <th width="10%">Disponible</th>
              <th width="10%">Medida</th>
              <th></th>
              <th width="5%">Opciones</th>
            </thead>
            <tbody>
              @foreach($insumos as $insumo)
                <tr id="{{$insumo->id}}">
                  <td id="{{$insumo->id}}" class="seleccionar">{{$insumo->cantidadUnidad}}</td>
                  <td id="{{$insumo->id}}" class="seleccionar">{{$insumo->nombre}}</td>
                  <td id="{{$insumo->id}}" class="seleccionar">{{$insumo->marca}}</td>
                  <td id="{{$insumo->id}}" class="seleccionar">{{$proveedores[$insumo->idProveedor]}}</td>
                  <td id="{{$insumo->id}}" class="seleccionar">{{$insumo->valorCompra}}</td>
                  <td id="{{$insumo->id}}" class="seleccionar">{{$insumo->precioUnidad}}</td>
                  <td id="{{$insumo->id}}" class="seleccionar">{{number_format($insumo->cantidadMedida,3)}}</td>
                  <td id="{{$insumo->id}}" class="seleccionar">
                    <?php if($insumo->medida == "0"){echo "oz";}else{echo "unidad";} ?>
                  </td>
                  <td id="{{$insumo->id}}" class="seleccionar">
                    <span  id="span{{$insumo->id}}" aria-hidden="true" data-toggle="tooltip"
                      <?php if($insumo->tipo == "1") echo "class='fa fa-check-square' title='Este producto se vende por botella'" ;?>
                      <?php if($insumo->tipo == "0") echo "class='fa fa-window-close' title='Este producto no se vende por botella'" ;?>
                    ></span>
                  </td>
                  <td>
                    <a class="table-actions pocketMorado" href=""><i class="fa fa-pencil" data-toggle="modal" href="#editModal{{$insumo->id}}" title="Editar Insumo"></i></a>
                    <a class="table-actions pocketMorado" href="#" onclick="eliminar({{$insumo->id}})"><i class="fa fa-trash-o" title="Eliminar Insumo"></i></a>
                  </td>
                </tr>

                <!-- <div class="modal fade in" id="editModal{{$insumo->id}}" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      {!! Form::open() !!}
                        <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
                          <button aria-hidden="true" type="button"  class="close" data-dismiss="modal" style="color:white">&times;
                          </button>
                          <h4 class="modal-title">Editar</h4>
                        </div>
                        <div class="modal-body">
                        <div class="pre-scrollable" >
                          <div class="widget-content">
                            <div class="form-group">
                              <label for="nombre" class="control-label">Nombre</label>
                              <input type="text" id="nombre{{$insumo->id}}" name="nombre" class="form-control" value="{{$insumo->nombre}}"/>
                            </div>
                            <div class="form-group">
                              <label for="marca" class="control-label">Marca</label>
                              <input type="text" id="marca{{$insumo->id}}" name="marca" class="form-control" value="{{$insumo->marca}}"/>
                            </div>
                            <div class="form-group">
                              <label for="idProveedor" class="control-label">Proveedor</label>
                              {!! Form::select('proveedores', $proveedores, $insumo->idProveedor, ['class' => 'form-control', 'id'=>'proveedores'.$insumo->id]) !!}
                            </div>
                            <div class="form-group">
                              <label for="valorCompra" class="control-label">Costo</label>
                              <input type="number" id="compra{{$insumo->id}}" step="any" min="0" name="valorCompra" class="form-control" value="{{$insumo->valorCompra}}" onkeyup="autocompletar(event,this,2)"/>
                            </div>
                            <div class="form-group">
                              <label for="precioUnidad" class="control-label">Venta</label>
                              <input type="number" id="venta{{$insumo->id}}" step="any" min="0" name="precioUnidad" class="form-control" value="{{$insumo->precioUnidad}}" onkeyup="autocompletar(event,this,3)"/>
                            </div>

                            <div class="form-group">
                              <label id="label{{$insumo->id}}" for="cantidadMedida" class="control-label"><?php if($insumo->medida == "0"){echo "Contenido";}else{echo "Cantidad";} ?></label>
                              <input type="number" id="cantMedida{{$insumo->id}}" min="0" step="any" name="cantidadMedida" class="form-control" value="{{$insumo->cantidadMedida}}"/>
                              <select name="medida" id="medida{{$insumo->id}}" class="form-control" onchange="editValor(this.value,{{$insumo->id}});"> 
                                <option value="2">ml</option> 
                                <option value="3">cm3</option> 
                                <option value="0" <?php if($insumo->medida =="0") echo "selected";?>>oz</option>
                                <option value="1" <?php if($insumo->medida =="1") echo "selected";?>>unidad</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="cantidadUnidad" class="control-label">Cantidad</label>
                              <input type="number" id="unidades{{$insumo->id}}" name="unidades{{$insumo->id}}" min="0" class="form-control" value="{{$insumo->cantidadUnidad}}" <?php if($insumo->medida == "1") echo'style="display:none;"' ?>/>
                            </div>
                            <div class="form-group">
                              <label for="tipo" class="control-label">¿Vender en botella?</label>
                              <label> &ensp;&ensp;&ensp;&ensp;<input type="checkbox" name="tipo" id="tipo{{$insumo->id}}" <?php if($insumo->tipo == "1") echo "checked";?> onchange="showContent({{$insumo->id}})" /><span></span></label>
                            </div>
                            <div id="content{{$insumo->id}}" <?php if($insumo->tipo == "0") echo "hidden";?>>
                              <label for="categorias" class="control-label">Categor&iacutea</label>
                              {!! Form::select('categorias', $categorias, null, ['class' => 'form-control', 'id'=>'categoria'.$insumo->id]) !!}
                            </div>
                            <br>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal" onclick="modificar({{$insumo->id}},{{$proveedores}})" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Guardar</button>
                        
                      </div>
                    {!! Form::close() !!} 
                  </div>
                </div>
              </div> -->
              <!--Modal para editar -->
              <div class="modal fade" id="editModal{{$insumo->id}}" role="dialog">
                <div class=" modal-body">
                  <div class="" style="background-color:#FFFFFF">
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
                                        <li data-target="#myCarousel" data-slide-to="2"></li>
                                    </ol>   
                                    <!-- Wrapper for carousel items -->
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <img src="/examples/images/slide1.png" alt="First Slide">
                                        </div>
                                        <div class="item">
                                            <img src="/examples/images/slide2.png" alt="Second Slide">
                                        </div>
                                        <div class="item">
                                            <img src="/examples/images/slide3.png" alt="Third Slide">
                                        </div>
                                    </div>
                                    <!-- Carousel controls 
                                    <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                    </a>
                                    <a class="carousel-control right" href="#myCarousel" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                    </a>
                                    -->
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
                                        <span class="input-group-addon"><i class="fa fa-500px"></i></span>
                                        {!! Form::select('proveedores', $proveedores, $insumo->idProveedor, ['class' => 'form-control', 'id'=>'proveedores'.$insumo->id]) !!}
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input type="number" id="compra{{$insumo->id}}" step="any" min="0" placeholder="Costo" name="valorCompra" class="form-control" value="{{$insumo->valorCompra}}" onkeyup="autocompletar(event,this,2)"/>
                                      </div>
                                    </div>

                                     <div class="form-group">
                                      <label for="tipo" class="control-label"> ¿Vender por botella?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                      <label> 
                                      <input type="checkbox" name="tipo" id="stipo{{$insumo->id}}" <?php if($insumo->tipo == "1") echo "checked";?> onchange="showContent({{$insumo->id}})" />
                                      <span></span>
                                      </label>
                                    </div>
                                    <div id="scontent{{$insumo->id}}" <?php if($insumo->tipo == "0") echo "hidden";?>>
                                      <label for="categorias" class="control-label">Categor&iacutea</label>
                                      {!! Form::select('categorias', $categorias, null, ['class' => 'form-control', 'id'=>'categoria'.$insumo->id]) !!}
                                    </div>
                                    <br>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class=" bs-example">
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
                                        <select name="medida" id="medida{{$insumo->id}}" class="form-control" onchange="editValor(this.value,{{$insumo->id}});"> 
                                          <option value="2">ml</option> 
                                          <option value="3">cm3</option> 
                                          <option value="0" <?php if($insumo->medida =="0") echo "selected";?>>oz</option>
                                          <option value="1" <?php if($insumo->medida =="1") echo "selected";?>>unidad</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div id="divcantidad{{$insumo->id}}" class="form-group" <?php if($insumo->medida == "1") echo'style="display:none;"' ?>>
                                      <div class="input-group">
                                        <span id="iconCantidad" class="input-group-addon"><i class="fa fa-superscript"></i></span>
                                        <input type="number" id="unidades{{$insumo->id}}" name="unidades{{$insumo->id}}" min="0" placeholder="Cantidad" class="form-control" value="{{$insumo->cantidadUnidad}}"/>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer" style="text-align: center;">
                                    <button class="btn btn-default" data-dismiss="modal" onclick="modificar({{$insumo->id}},{{$proveedores}})" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >
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
{!!$insumos->appends(Request::all())->render() !!}

<script>
  var routeModificar = "http://localhost/PocketByR/public/insumo/modificar";
  var routeEliminar = "http://localhost/PocketByR/public/insumo/eliminar";

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

  function modificar(idInsumo,proveedores){
    var nombre = $("#nombre"+idInsumo).val();
    var marca = $("#marca"+idInsumo).val();
    var proveedor = $("#proveedores"+idInsumo).val();
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
        unidades: unidades,
        compra: compra,
        venta: venta,
        cantMedida: cantMedida,
        medida: medida,
        tipo: tipo,
        categoria: categoria
      },
      success: function(){
        if(tipo == '1'){
          document.getElementById('span'+idInsumo).className = "glyphicon glyphicon-ok tooltip-trigger";
          document.getElementById('span'+idInsumo).title = "Este producto se vende por botella";
        }else{
          document.getElementById('span'+idInsumo).className = "glyphicon glyphicon-remove tooltip-trigger";
          document.getElementById('span'+idInsumo).title = "Este producto no se vende por botella";
        }        
        $("#"+idInsumo).children("td").each(function (indextd){
          if(indextd == 1){
            $(this).text(nombre);
          }else if(indextd == 2){
            $(this).text(marca);
          }else if(indextd == 3){
            $(this).text(proveedores[proveedor]);
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
              $(this).text("oz");
            }else{
              $(this).text("unidad");
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
