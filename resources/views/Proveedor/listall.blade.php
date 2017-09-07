
<table class="table table-striped">
  <thead>
    <th>Nombre</th>
    <th>Dirección</th>
    <th>Telefono</th>
    <th width="20"></th>
  </thead>
  <tbody>
  @foreach($proveedores as $proveedor)
    <tr id="{{$proveedor->id}}">
      <td id="{{$proveedor->id}}" class="seleccionar">{{$proveedor->nombre}}</td>
      <td id="{{$proveedor->id}}" class="seleccionar">{{$proveedor->direccion}}</td>
      <td id="{{$proveedor->id}}" class="seleccionar">{{$proveedor->telefono}}</td>
      <td align="right"">
        <button class="btn btn-default" onclick="eliminar({{$proveedor->id}})" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
      </td>
    </tr>
    <div class="modal fade in" id="editModal{{$proveedor->id}}" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content">
          {!! Form::open() !!}
            <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
              <button aria-hidden="true" type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
              <h4 class="modal-title">Editar proveedor</h4>
            </div>
            <div class="modal-body">
              <div>
                <div class="widget-content">
                  <div class="form-group">
                    <div class="form-group">
                     
                      <input type="text" id="nombre{{$proveedor->id}}" name="nombre" class="form-control" value="{{$proveedor->nombre}}"/>
                    </div>
                    <div class="form-group">
                      <input type="text" id="direccion{{$proveedor->id}}" name="direccion" class="form-control" value="{{$proveedor->direccion}}"/>
                    </div>
                    <div class="form-group">
                      <input type="text" id="telefono{{$proveedor->id}}" name="telefono" class="form-control" value="{{$proveedor->telefono}}"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-default" data-dismiss="modal" onclick="modificar({{$proveedor->id}})" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Guardar</button>

            </div>
            <script type="text/javascript">
                function ocultar(){
                    document.getElementById('oculto').style.display = 'none';
                }
            </script>
            {!! Form::close() !!} 
          </div>
        </div>        
      </div>  
      @endforeach
    </tbody>
  </table>

  
  <script>
    var routeModificar = "http://localhost/PocketByR/public/proveedor/modificar";
    var routeEliminar = "http://localhost/PocketByR/public/proveedor/eliminar";

    function modificar(idProveedor) {
      var nombre = $("#nombre"+idProveedor).val();
      var direccion = $("#direccion"+idProveedor).val();
      var telefono = $("#telefono"+idProveedor).val();
      $.ajax({
        url: routeModificar,
        type: 'GET',
        data: {
          id: idProveedor,
          nombre: nombre,
          direccion: direccion,
          telefono: telefono
        },
        success: function(data){
          $("#"+idProveedor).children("td").each(function (indextd)
            {
              if(indextd == 0){
                $(this).text(nombre);
              }else if(indextd == 1){
                $(this).text(direccion);
              }
              else if(indextd == 2){
                $(this).text(telefono);
              }
            });
        },
        error: function(data){
          alert("Error al modificar proveedor.");
        }
      });
    }

    function eliminar(idProveedor){
      if(confirm('¿Desea eliminar este proveedor?')){
        $.ajax({
          url: routeEliminar,
          type: 'GET',
          data: {
            id: idProveedor
          },
          success: function(){
            $("#"+idProveedor).remove();
          },
          error: function(data){
            alert('No se puede eliminar el proveedor, debido a que se está utilizando.');
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