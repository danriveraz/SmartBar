<table id="tabla" class="table table-striped">
    <thead>
      <th></th>
      <th></th>
      <th width="20"></th>
    </thead>
    <tbody>
      
	@foreach($mesas as $mesa)
    	<tr id="{{$mesa->id}}">
    		<td id="{{$mesa->id}}" class="seleccionar">{{$mesa->nombreMesa}}</td>
    		<td id="{{$mesa->id}}" class="seleccionar">{{$mesa->estado}}</td>
        <td align="right" >
          <button class="btn btn-default" onclick="eliminar({{$mesa->id}});" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
          <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
          </button>
        </td>
    	</tr>
    @endforeach 

    </tbody>
  </table>


  @foreach($mesas as $mesa)
  <div class="modal fade" id="myModal{{$mesa->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
          <button aria-hidden="true" class="close" data-dismiss="modal" type="button"  style="color:white">&times;</button>
          <h4 class="modal-title">
            {{$mesa->nombreMesa}}
          </h4>
        </div>
        <div class="modal-body">
            <div class="heading">
                
            </div>
            <div class="widget-content">
             <div class="form-group">
                <div class="form-group">
                    <input type="text" id="nombre{{$mesa->id}}" class="form-control" value="{{$mesa->nombreMesa}}" />
                </div>
                <div class="form-group">
                    <select id="estado{{$mesa->id}}"  class="form-control">
                      <option value="Disponible" <?php if($mesa->estado == "Disponible") echo "selected=''" ?> >Disponible</option>
                      <option value="Ocupada"  <?php if($mesa->estado == "Ocupada") echo "selected=''" ?> >Ocupada</option>
                      <option value="Reservada" <?php if($mesa->estado == "Reservada") echo "selected=''" ?> >Reservada</option>
                    </select>
                </div>
              </div>  
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-dismiss="modal"  style="BACKGROUND-COLOR: rgb(79,0,85); color:white" onclick="modificar({{$mesa->id}})">Guardar</button>
        </div>
      </div>
    </div>
  </div>
@endforeach 

<script type="text/javascript">
  
var routeEliminar = "http://pocketdesigner.co/PocketByR/public/mesas/eliminar";
var routeModificar = "http://pocketdesigner.co/PocketByR/public/mesas/modificar";
function eliminar(idMesa){
      if(confirm('¿Desea eliminar esta mesa?')){
        $.ajax({
          url: routeEliminar,
          type: 'GET',
          data: {
            id: idMesa
          },
          success: function(){
            $("#"+idMesa).remove();
          },
          error: function(data){
            alert('No se puede eliminar la mesa, debido a que se está utilizando.');
          }
        });
      }
    }
  function modificar(idMesa) {
      var nombre = $("#nombre"+idMesa).val();
      var estado = $("#estado"+idMesa).val();
      $.ajax({
        url: routeModificar,
        type: 'GET',
        data: {
          id: idMesa,
          nombre: nombre,
          estado: estado
        },
        success: function(data){
          $("#"+idMesa).children("td").each(function (indextd)
            {
              if(indextd == 0){
                $(this).text(nombre);
              }else if(indextd == 1){
                $(this).text(estado);
              }
            });
        },
        error: function(data){
          alert("Error al modificar mesa.");
        }
      });
    }

$(".seleccionar").click(function(){
    var idElegido = $(this).attr("id");
    var palabra = "#myModal";
    var id = palabra.concat(idElegido);
    $(id).modal();
});
</script>

