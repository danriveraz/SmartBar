<div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
      <div class="widget-content padded clearfix">
        <table class="table table-bordered table-striped" id="example">
          <thead>
            <th width="18%">Nombre</th>
            <th width="10%">Precio</th>
            <th width="11%">Categoria</th>
            <th width="3%">Opciones</th>
          </thead>
          <tbody>
            @foreach($productos as $producto)
              @if($producto->eliminado == false)
              <tr id="{{$producto->id}}">
                <td id="{{$producto->id}}" class="seleccionar">{{$producto->nombre}}</td>
                <td id="{{$producto->id}}" class="seleccionar">{{$producto->precio}}</td>
                <td id="{{$producto->id}}" class="seleccionar">{{$categorias[$producto->idCategoria]}}</td>
                <td>
                  <div>
                    <a class="table-actions pocketMorado" href="">
                      <i class="fa fa-book" data-toggle="modal" href="#modalReceta{{$producto->id}}"  title="Preparación"></i>
                      <!-- Se comenta la función onclick debido a que genera error, revisar en caso de que esta sea necesaria-->
                      <!-- onclick="ingredientes({{$producto->id}})" -->
                    </a>
                    <a class="table-actions pocketMorado" href="{{route('producto.contenido', $producto->id)}}">
                      <i class="fa fa-pencil" title="Editar"></i>
                    </a>
                    <a class="table-actions pocketMorado" href="#" onclick="eliminarProducto({{$producto->id}})">
                      <i class="fa fa-trash-o" title="Eliminar"></i>
                    </a>
                  </div>
                </td>
                <div class="modal fade" id="modalReceta{{$producto->id}}" role="dialog">
                  <div class="dialog1 modal-dialog">
                    <div class="modal-content" style="background-color:#FFFFFF">
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
                                  <div class="col-md-5">
                                    <div class="bs-example">
                                      <img src="{{asset('images/productos/'.$producto->imagen)}}" alt="{{$producto->nombre}}">
                                    </div>
                                  </div>
                                  <!-- segunda columna-->
                                  <div class="col-md-7">
                                    <div class=" bs-example">
                                      <h3><a class="pocketMorado">{{$producto->nombre}}</a></h3>
                                      <a class="pocketMorado">{{$producto->descripcion}}</a><br><br>
                                      <div class="true"  id="ingredientes{{$producto->id}}"></div>
                                      <div class="">
                                        <strong><a class="pocketMorado">Elaboración</a><br></strong>
                                          {{$producto->receta}}<br>
                                        <a class="pocketMorado"><b>Copa o Vaso:</b>{{$producto->vaso}}</a><br>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- fin de segunda columna-->
                                </div>
                              </fieldset>
                            </form>
                          </div>
                        </div>
                        <!-- End modal producto -->
                      </div>
                    </div>
                  </div>
                </div>
              </tr>
            @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    cambiarCurrent("#miCarta");
    $('#example').DataTable( {
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
  });

  function cambiarCurrent(idInput) {
    $(".current").removeClass("current");
    $(idInput).addClass("current");
  };

  var routeModificar = "http://localhost/SmartBar/public//producto/modificar";
  var routeEliminarProducto = "http://localhost/SmartBar/public//producto/eliminar";
  var routeIngredientes = "http://localhost/SmartBar/public//producto/ingredientes";

  function ingredientes(idProducto){
    if(document.getElementById("ingredientes"+idProducto).className == "true"){
      $.ajax({
        url: routeIngredientes,
        type: 'GET',
        data: {
          id: idProducto
        },
        success: function(data){
          var contiene = $.parseJSON(data);
          var lista = "";
          for (var i = 0; i < contiene.length; i++) {
            var medida = ' oz de ';
            if(contiene[i][2] != 0){
              medida = ' unidades de ';
            }
            lista += '<i class="padded5 fa fa-caret-right"></i><a class="padded pocketMorado">'
                  + contiene[i][0]
                  + medida
                  + contiene[i][1]
                  + '</a><br>';
          }
          lista += '<br>';
          $("#ingredientes"+idProducto).before(lista);
          document.getElementById("ingredientes"+idProducto).className = "false";
        },
        error: function(data){

        }
      });
    }
  }

  function modificar(idProducto,categorias){
    var nombre = $("#nombre"+idProducto).val();
    var categoria = $("#categoria"+idProducto).val();
    var precio = $("#precio"+idProducto).val();
    $.ajax({
      url: routeModificar,
      type: 'GET',
      data: {
        id: idProducto,
        nombre: nombre,
        categoria: categoria,
        precio: precio
      },
      success: function(){
        $("#"+idProducto).children("td").each(function (indextd){
          if(indextd == 0){
            $(this).text(nombre);
          }else if(indextd == 2){
            $(this).text(categorias[categoria]);
          }else if(indextd == 1){
            $(this).text(precio);
          }
        });
      },
      error: function(data){
        alert('Error al modificar producto');
      }
    });
  }

  function eliminarProducto(idProducto){
    if(confirm('¿Desea eliminar este producto?')){
      $.ajax({
        url: routeEliminarProducto,
        type: 'GET',
        data: {
          id: idProducto
        },
        success: function(){
          $("#"+idProducto).remove();
        },
        error: function(data){
          alert('Ooops discúlpanos, hemos tenido un error al modificar tu producto.');
        }
      });
    }
  }

  $(".seleccionar").click(function(){
    var idElegido = $(this).attr("id");
    var palabra = "#modalReceta";
    var id = palabra.concat(idElegido);
    $(id).modal();
});
</script>