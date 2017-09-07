<table class="table table-striped">
    <thead>
      <th>Nombre</th>
      <th>Precio</th>
      <th width="20"></th>
    </thead>
    <tbody>
      @foreach($categorias as $categoria)
        <tr id="{{$categoria->id}}">
          <td  id="{{$categoria->id}}" class="seleccionar">{{$categoria->nombre}}</td>
          <td  id="{{$categoria->id}}" class="seleccionar">{{$categoria->precio}}</td>
          <td align="right">
           <button class="btn btn-default" onclick="eliminar({{$categoria->id}})" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          </td>
        </tr>

        <div class="modal fade" id="editModal{{$categoria->id}}" role="dialog" >
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
                <button aria-hidden="true" type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
                  <h4 class="modal-title">
                  Editar categoría
                  </h4>
                </div>
                <div class="modal-body">
                  <div class="" >
                  <div class="widget-content">
                    <div class="form-group">
                      <div class="form-group">
                        <input type="text" id="nombre{{$categoria->id}}" placeholder="Nombre" class="form-control" value="{{$categoria->nombre}}" required="true" />
                      </div>
                      <div class="form-grup">
                          <input type="number" placeholder="Precio" min="0" step="any" id="precio{{$categoria->id}}" class="form-control" value="{{$categoria->precio}}"/>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-default" data-dismiss="modal" onclick="modificar({{$categoria->id}})" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Guardar</button>
                </div>
          </div>
  </div>


        </div>
      @endforeach
    </tbody>
</table>
<script type="text/javascript">
  var routeModificar = "http://localhost/PocketByR/public//categoria/modificar";
  var routeEliminar = "http://localhost/PocketByR/public//categoria/eliminar";

  function modificar(idCategoria){
    var nombre = $("#nombre"+idCategoria).val();
    var precio = $("#precio"+idCategoria).val();
    $.ajax({
      url: routeModificar,
      type: 'GET',
      data: {
        id: idCategoria,
        nombre: nombre,
        precio: precio
      },
      success: function(){
        $("#"+idCategoria).children("td").each(function (indextd){
          if(indextd == 0){
            $(this).text(nombre);
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

   function eliminar(idCategoria){
    if(confirm('¿Desea eliminar esta categoria?')){
      $.ajax({
        url: routeEliminar,
        type: 'GET',
        data: {
          id: idCategoria
        },
        success: function(){
            $("#"+idCategoria).remove();
        },
        error: function(data){
          alert('No se puede eliminar la categoria, ya que existe historial de productos del mismo.');
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
