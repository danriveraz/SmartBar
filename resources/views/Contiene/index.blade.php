@extends('Layout.app_administradores')
@section('content')

<!-- Nav tabs nombre de la lista -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#yorkminster" aria-controls="home" role="tab" data-toggle="tab" class="pocketMorado">Contenido del Producto</a></li>
            <li role="presentation"><a class="pocketMorado" href="#yorkcastle" aria-controls="profile" role="tab" data-toggle="tab">Preparación</a></li>
            <!--<li role="presentation"><a href="#yorkmuseumgardens" aria-controls="profile" role="tab" data-toggle="tab">York Museum Gardens</a></li>-->
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="yorkminster">
 <div class="container-fluid main-content">
        <!--<div class="page-title">
          <h1>
            Basic Tables
          </h1>
        </div>-->
        <p></p>
        <p></p>

          <!-- end Condensed Table -->
        <div class="row">
          <!-- Hover Row Table -->
          <div class="col-lg-3">
          <div  class="text-center"><a class="btn btn-bitbucket" href="{{route('producto.index')}}"><i class="fa fa-arrow-left"></i>Ir Atras</a></div>
          </div>
          <!-- end Hover Row Table --><!-- Responsive Table -->
          <div class="col-lg-6">
        <div class=" text-center page-title">

            <div class="row">
              <div class="col-lg-6">
        <div>
          <h2>
      <input class="Titulo-css2" id="nombre" placeholder="Ingrese Nombre" value="{{$producto->nombre}}"/>
          </h2>
        </div> 

              </div>
              <div class="col-lg-6">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-outdent"></i></span>
                {!! Form::select('categorias', $categorias, $producto->idCategoria, ['class'=>'select2able', 'placeholder' => 'Categorias', 'id' => 'categoria']) !!}
              </div>
            </div>
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                <input class="form-control" id="precio" placeholder="Precio del Producto" type="text" value="{{$producto->precio}}">
              </div>
            </div>
             </div>
            </div>

        </div>          
            <div class="widget-container fluid-height clearfix" style="box-shadow: none;">
              <div class="heading">
                <i class=" pocketMorado fa fa-table"></i><a class="pocketMorado">Productos Selecionados</a>
              </div>
              <div class="widget-content padded clearfix">
                <table class="table table-striped" id="insumoAgregados">
                  <thead>
                    <th style="display: none;"></th>
                    <th>
                      Nombre
                    </th>
                    <th class="text-center">
                      Cantidad
                    </th>
                    <th class="text-center">
                      Medida
                    </th>
                    <th></th>
                  </thead>
                  <tbody>
                    @foreach($contienen as $contiene)
                    <tr id="fila{{$contiene->idInsumo}}">
                      <td style="display: none;">{{$contiene->idInsumo}}</td>
                      <td>
                        {{$insumos[$contiene->idInsumo]}}
                      </td>
                      <td class="text-center">
                        {{$contiene->cantidad}}
                      </td>
                      <td class="text-center">
                        <span class="label label-Pocket">
                          <b><?php if($medidas[$contiene->idInsumo] == 1) echo "Unidad"; else echo "Onza";?></b>
                        </span>
                      </td>
                      <td>
                        <div class="action-buttons">
                      <a class="table-actions pocketMorado"><i class="fa fa-window-close" title="Cancelar" onclick="eliminarInsumo({{$producto->id}},{{$contiene->idInsumo}})"></i></a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
           </div>
        </div>
      </div>      
      
      
      
      
      <div class="container main-content">
        <!-- DataTables Example -->         
        <div class="row"> 
 <!-- fin de la tabla de selecion de productos-->      
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="pocketMorado fa fa-check-square-o"></i><a class="pocketMorado">Mi Inventario</a>
              </div>
              <div class="widget-content padded clearfix">
                <table class="table table-bordered table-striped" id="dataTable1">
                  <thead>
                    <th width="30%">
                      Nombre
                    </th>
                    <th width="25%">
                      Marca
                    </th>
                    <th width="15%">
                      Cantidad
                    </th>
                   <th width="15%" class="text-center">
                      En Inventario
                    </th>
                   <th width="15%" class="text-center">
                      Medida
                    </th>

                   <th width="5%" class="text-center">
                      Opciones
                    </th>
                  </thead>
                  <tbody>
                    @foreach($insumosDisponibles as $insumo)
                    <tr data-toggle="modal">
                      <td>
                        {{$insumo->nombre}}
                      </td>
                      <td>
                        {{$insumo->marca}}
                      </td>
                      <td>
                        <input type="number" class="Titulo-css" id="{{$insumo->id}}" onkeypress="tecla(event,{{$insumo}})" placeholder="Ingrese Cantidad" />
                      </td>
                      <td class="text-center">
                        {{$insumo->cantidadRestante}}
                      </td>
                      <td class="text-center">
                        <span class="label label-Pocket">
                          <b><?php if($insumo->medida == 1) echo "Unidad"; else echo "Onza";?></b>
                        </span>
                      </td>                     
                      <td class="text-center actions">
                        <div class="action-buttons">
                          <a class="table-actions pocketMorado"><i class="fa fa-plus" onclick="adicionarInsumo({{$insumo}})" title="Adicionar Insumo"></i></a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div> 
            
          </div> 
         
        </div> 
        
        
             <div class="text-center"><a class="btn btn-bitbucket" onclick="enviarDatos({{$producto->id}})"><i class="fa fa-send"></i>Guardar Producto</a></div>                                 

        <!-- end DataTables Example -->
      </div> 
    


            </div>
            
            
            
            
            <div role="tabpanel" class="tab-pane" id="yorkcastle">            
              <div class="container main-content">
                <!-- DataTables Example -->         
                <div class="row"> 
         <!-- fin de la tabla de selecion de productos-->      
                  <div class="col-lg-12">

              <div class="col-lg-4">                 
                <div class="bs-example">
                  <img src="images/productos/{{$producto->imagen}}" alt="{{$producto->nombre}}">
                </div>
                
         <!--<div class="text-center"><a class="btn btn-bitbucket" onclick=""><i class="fa fa-send"></i>Guardar Producto</a></div>-->
                                            
              </div> <!-- fin del modal 1-->
              
              <div class="col-lg-8">
              <div class="widget-content padded">
                <textarea class="form-control" id="descripcion" style="height: 50px" placeholder="Descripci&oacute;n del producto">{{$producto->descripcion}}</textarea><br>
                <textarea class="form-control" id="receta" style="height: 200px" placeholder="Preparaci&oacute;n del producto">{{$producto->receta}}</textarea><br>
                <input type="text" name="copa" class="form-control" id="copa" placeholder="Tipo de copa o vaso" value="{{$producto->vaso}}">
                <!--<div id="summernote">
                  {{$producto->receta}}
                </div>-->
              </div>
              </div> <!-- fin del modal 2-->             
                    
                    </div>
                  </div>  
               </div>     
            </div>
            <!--<div role="tabpanel" class="tab-pane" id="yorkmuseumgardens">
                <h3>York Museum Gardens</h3>
                <p>The <strong>York Museum Gardens</strong> are botanic gardens in the centre of York, England, beside 
                    the River Ouse. They cover an area of 10 acres (4.0 ha) of the former grounds of St Mary's Abbey, 
                    and were created in the 1830s by the Yorkshire Philosophical Society along with the Yorkshire 
                    Museum which they contain.</p>
            </div>  -->          
        </div>




@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

  var routeEliminar = "http://localhost/PocketByR/public/contiene/eliminar";
  var routeGuardar = "http://localhost/PocketByR/public/contiene/guardar";

  function tecla(e,insumo){
    if(e.which == 13){
      adicionarInsumo(insumo);
    }
  }

  function adicionarInsumo(insumo){
    var cantidad = $("#"+insumo.id).val();
    var medida = insumo.medida;//$("#medida"+insumo.id).val();
    /*if(medida == 2 || medida == 3){
      var cantidadAux = cantidad/30;
      cantidad = cantidadAux;
    }*/
    var medidaInsumo = "Onza";
    if(medida== 1){
      medidaInsumo = "Unidad";
    }
    if(cantidad>0){
      if(document.getElementById("fila"+insumo.id)!=null){
        $("#fila"+insumo.id).children("td").each(function (indextd)
          {
            if(indextd == 2){
              var nuevaCantidad = parseFloat($(this).text())+parseFloat(cantidad);
              $(this).text(nuevaCantidad);
            }
          });
        }
      else{
        var fila = '<tr id="fila'+insumo.id+'"><td style="display: none;">'+insumo.id+'</td><td>'+insumo.nombre+'</td><td class="text-center">'+cantidad+'</td><td class="text-center"><span class="label label-Pocket"><b>'+medidaInsumo+'</b></span></td><td><div class="action-buttons"><a class="table-actions pocketMorado"><i class="fa fa-window-close" title="Cancelar" onclick="eliminarInsumo({{$producto->id}},'+insumo.id+')"></i></a></div></td></tr>';
        $("#insumoAgregados").append(fila);
      }
      $("#"+insumo.id).val('');
      $("#medida"+insumo.id).val(insumo.medida);
    }
  }

  /*sfunction modificarInsumo(insumo){
    var cantidad = $("#"+insumo.id).val();
    var medida = $("#medida"+insumo.id).val();
    if(medida == 2 || medida == 3){
      var cantidadAux = cantidad/30;
      cantidad = cantidadAux;
    }
    if(cantidad>0){
      if(document.getElementById("fila"+insumo.id)!=null){
        $("#fila"+insumo.id).children("td").each(function (indextd)
          {
            if(indextd == 2){
              $(this).text(cantidad);
            }
          });
        }
      $("#"+insumo.id).val('');
      $("#medida"+insumo.id).val(insumo.medida);
    }
  }  

  /*function adicionarTodo(){
    var insumos = [];
    var nombres = [];
    var medida = [];
      $("table#dataTable1 tr").each(function() {
        $(this).children("td").each(function (indextd)
          {
            if(indextd == 0){
              insumos.push($(this).text());
            }else if(indextd == 1){
              nombres.push($(this).text());
            }
        })
      });
      for(var i = 0; i < insumos.length; i++){
        var cantidad = $("#"+insumos[i]).val();
        medida[i] = $("#medida"+insumos[i]).val();
        if(medida[i] == 2 || medida[i] == 3){
          var cantidadAux = cantidad/30;
          cantidad = cantidadAux;
        }        
        if(cantidad != 0){
          if(document.getElementById("fila"+insumos[i])!=null){
            $("#fila"+insumos[i]).children("td").each(function (indextd)
            {
              if(indextd == 2){
                var nuevaCantidad = parseFloat($(this).text())+parseFloat(cantidad);
                $(this).text(nuevaCantidad);
              }
            });            
          }
          else{
            /*var fila = '<tr id="fila'+insumos[i]+'"><td  style="display: none;">'+insumos[i]+'</td><td>'+nombres[i]+'</td><td>'+cantidad+'</td><td><button type="submit" class="btn btn-dufault" onclick="eliminarInsumo({{$producto->id}},'+insumos[i]+')" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>';
            $("#insumoAgregados").append(fila);
          }
          $("#"+insumos[i]).val('');
          $("#medida"+insumos[i]).val(medida[i]);
        }
      }
  }*/

  function eliminarInsumo(idProducto,idInsumo){
    if(confirm('¿Desea eliminar este insumo?')){
      $.ajax({
        url: routeEliminar,
        type: 'GET',
        data: {
          idProducto: idProducto,
          idInsumo: idInsumo
        },
        success: function(){
          $("#fila"+idInsumo).remove();
        },
        error: function(data){
          alert('Error al eliminar insumo');
        }
      });
    }
  }

  function enviarDatos(idProducto){
    if(confirm('¿Desea Guardar todos los insumos agregados?')){
      var nombre = $("#nombre").val();
      var precio = $("#precio").val();
      var categoria = $("#categoria").val();
      var descripcion = $("#descripcion").val();
      var receta = $("#receta").val();
      var copa = $("#copa").val();
      var idInsumos = [];
      var cantidades = [];
      $("table#insumoAgregados tr").each(function() {
        $(this).children("td").each(function (indextd)
          {
            if(indextd == 0){
              idInsumos.push($(this).text());
            }else if(indextd == 2){
              cantidades.push($(this).text());
            }
        })
      });
      $.ajax({
          url: routeGuardar,
          type: 'GET',
          data:{
            idProducto: idProducto,
            nombre: nombre,
            precio: precio,
            categoria: categoria,
            receta: receta,
            descripcion: descripcion,
            copa: copa,
            insumos: idInsumos,
            cantidades: cantidades
          },
          success : function() {
            document.location.href='producto';
        },
          error: function(data){
            alert('Error al adicionar insumos');
        }
      });
    }
  }  

</script>
<style>
    .center-block {
        float: none;
        margin-left: auto;
        margin-right: auto;
    }
    
    .input-group .icon-addon .form-control {
        border-radius: 0;
    }
    
    .icon-addon {
        position: relative;
        color: rgb(79,0,85);
        display: block;
    }
    
    .icon-addon:after,
    .icon-addon:before {
        display: table;
        content: " ";
    }
    
    .icon-addon:after {
        clear: both;
    }
    
    .icon-addon.addon-md .glyphicon,
    .icon-addon .glyphicon, 
    .icon-addon.addon-md .fa,
    .icon-addon .fa {
        position: absolute;
        z-index: 2;
        left: 10px;
        font-size: 14px;
        width: 20px;
        margin-left: -2.5px;
        text-align: center;
        padding: 10px 0;
        top: 1px
    }
    
    .icon-addon.addon-lg .form-control {
        line-height: 1.33;
        height: 46px;
        font-size: 18px;
        padding: 10px 16px 10px 40px;
    }
    
    .icon-addon.addon-sm .form-control {
        height: 30px;
        padding: 5px 10px 5px 28px;
        font-size: 12px;
        line-height: 1.5;
    }
    
    .icon-addon.addon-lg .fa,
    .icon-addon.addon-lg .glyphicon {
        font-size: 18px;
        margin-left: 0;
        left: 11px;
        top: 4px;
    }
    
    .icon-addon.addon-md .form-control,
    .icon-addon .form-control {
        padding-left: 30px;
        float: left;
        font-weight: normal;
    }
    
    .icon-addon.addon-sm .fa,
    .icon-addon.addon-sm .glyphicon {
        margin-left: 0;
        font-size: 12px;
        left: 5px;
        top: -1px
    }
    
    .icon-addon .form-control:focus + .glyphicon,
    .icon-addon:hover .glyphicon,
    .icon-addon .form-control:focus + .fa,
    .icon-addon:hover .fa {
        color: rgb(79,0,85);
    }
  </style>
