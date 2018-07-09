
<div class="row">
  <div class="col-sm-12">
    <div class="widget-container fluid-height clearfix">
      <div class="widget-content padded clearfix">
        <table class="table table-bordered table-striped" id="tablaCategorias">
          <thead>
            <th width="1%" id="no">No.</th>
            <th width="45%">Nombre</th>
            <th width="45%">Precio</th>
            <th width="9%" id="opcionesCategorias">Opciones</th>
          </thead>
          <tbody>
            @foreach($categorias as $categoria)
              <tr id="categoria{{$categoria->id}}">
                <div>
                  <td id="categoria{{$categoria->id}}">
                    <a class="popover-trigger" readonly value="0"  data-content="Cantidad de productos que pertenecen a esta categoría" data-html="true" data-placement="bottom" data-toggle="popover" style="width: 100%; color: #5A5A5A;">0
                    </a>
                  </td>
                </div>
                <td id="categoria{{$categoria->id}}" class="seleccionar">{{$categoria->nombre}}</td>
                <td id="categoria{{$categoria->id}}" class="seleccionar">{{$categoria->precio}}</td>
                <td>
                  <a class="table-actions pocketMorado" href="">
                    <i class="fa fa-pencil" data-toggle="modal" href="#editModalCategoria{{$categoria->id}}" title="Editar categoría"></i>
                  </a>
                  <a class="table-actions pocketMorado" href="#" onclick="eliminarCategoria({{$categoria->id}})">
                    <i class="fa fa-trash-o" title="Eliminar categoría"></i>
                  </a>
                </td>
              </tr>
              <!-- MODAL EDIT -->
              <div class="modal fade" id="editModalCategoria{{$categoria->id}}" role="dialog">
                <div class="modal-dialog modal-md" style="width: 50%;">
                  <div class="modal-content" style="background-color:#FFFFFF">
                    <!-- class="modal-content" -->
                      <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
                        <button aria-hidden="true" type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
                        <h4 class="modal-title">
                        Editar categoría
                        </h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="widget-content padded">
                            {!! Form::open() !!}
                              <fieldset>
                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="bs-example">
                                        <div id="myCarousel" class="carousel" data-ride="carousel">
                                        <!-- Carousel indicators -->  
                                          <!-- Wrapper for carousel items -->
                                          <div class="carousel-inner">
                                            <img src="{{ asset ('images/categorias/'.$categoria->imagen)}}" style="width: 150px; height: 150px;">
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                  <div class="col-md-8">
                                    <div class="widget-content">
                                      <div class="form-group">
                                        <div class="form-group">
                                          <input type="text" id="nombreCategoria{{$categoria->id}}" placeholder="Nombre" class="form-control" value="{{$categoria->nombre}}" required="true" />
                                        </div>
                                        <div class="form-grup">
                                          @if($categoria->precio == 0)
                                          <input type="number" placeholder="Precio" min="0" step="any" id="precioCategoria{{$categoria->id}}" class="form-control"/>
                                          @else
                                          <input type="number" placeholder="Precio" min="0" step="any" id="precioCategoria{{$categoria->id}}" class="form-control" value="{{$categoria->precio}}"/>
                                          @endif
                                        </div>
                                      </div>
                                    </div>
                                  </div>   
                                  <div class="modal-footer">
                                    <button class="btn btn-default" data-dismiss="modal" onclick="modificarCategoria({{$categoria->id}})" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Guardar</button>
                                  </div>
                                </div>
                              </fieldset>
                            {!! Form::close() !!} 
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <!-- FIN MODAL EDIT -->
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var JSONproductos = eval(<?php echo json_encode($arregloProductos); ?>);
  $(".popover-trigger").popover();
  for(var i = 0; i < JSONproductos.length; i++){
    if(JSONproductos[i][0] != null){
      $("#categoria"+JSONproductos[i][0].idCategoria).children("td").children("a").each(function (indextd){
      if(indextd == 0){
        $(this).text(JSONproductos[i].length);
      }
    });
    }
  }

  $("body").on("mouseenter",".popover-trigger",function(event){
    var num = 1;
    var campoOculto = document.getElementsByClassName("popover fade bottom in");
      if((num == 1 && campoOculto.length == 0) || (num == 2 && campoOculto.length == 1)){
        $(this).click();
      }else{
        $(this).click();
        $(this).click();
      }
  });

  $("body").on("mouseleave",".popover-trigger",function(event){
    var num = 2;
    var campoOculto = document.getElementsByClassName("popover fade bottom in");
      if((num == 1 && campoOculto.length == 0) || (num == 2 && campoOculto.length == 1)){
        $(this).click();
      }else{
        $(this).click();
        $(this).click();
      }
  });

  var routeModificarCategoria = "http://localhost/SmartBar/public//categoria/modificar";
  var routeEliminarCategoria = "http://localhost/SmartBar/public//categoria/eliminar";

  function modificarCategoria(idCategoria){
    var nombre = $("#nombreCategoria"+idCategoria).val();
    var precio = $("#precioCategoria"+idCategoria).val();

    $.ajax({
      url: routeModificarCategoria,
      type: 'GET',
      data: {
        id: idCategoria,
        nombre: nombre,
        precio: precio
      },

      success: function(){
        $("#categoria"+idCategoria).children("td").each(function (indextd){
          if(indextd == 1){
            $(this).text(nombre);
          }else if(indextd == 2){
            $(this).text(precio);
          }
        });
        
      },
      error: function(data){
        alert('Error al modificar');
      }
    });       
  }

   function eliminarCategoria(idCategoria){
    if(confirm('¿Desea eliminar esta categoria?')){
      $.ajax({
        url: routeEliminarCategoria,
        type: 'GET',
        data: {
          id: idCategoria
        },
        success: function(){
            $("#categoria"+idCategoria).remove();
        },
        error: function(data){
          alert('No se puede eliminar la categoria, ya que existe historial de productos del mismo.');
        }
      });
    }
  }

  $(".seleccionar").click(function(){
    var idElegido = $(this).attr("id");
    idElegido = idElegido.slice(9);
    var palabra = "#editModalCategoria";
    var id = palabra.concat(idElegido);
    $(id).modal();
  });

  $("#tablaCategorias").DataTable( {
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
              }
          ]
      } );
</script>

<style type="text/css">
  #flotante
  {
    position: absolute;
    display:none;
    font-family:Arial;
    font-size:0.8em;
    border:1px solid #808080;
    background-color:#f1f1f1;
  }
</style>
