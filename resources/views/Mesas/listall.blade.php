<div class="row">
  <div class="col-sm-12">
    <div class="widget-container fluid-height clearfix">
      <div class="widget-content padded clearfix">
        <table class="table table-bordered table-striped" id="dataTable2">
          <thead>
            <th width="1%" hidden="true"> </th>
            <th width="45%">Nombre</th>
            <th width="45%">Estado</th>
            <th width="9%" id="opcionesMesas">Opciones</th>
          </thead>
          <tbody>
          	@foreach($mesas as $mesa)
            	<tr id="mesa{{$mesa->id}}">
                <td hidden="true"> </td>
            		<td id="mesa{{$mesa->id}}" class="seleccionar">{{$mesa->nombreMesa}}</td>
            		<td id="mesa{{$mesa->id}}" class="seleccionar">{{$mesa->estado}}</td>
                <td align="right" >
                  <a class="table-actions pocketMorado" href="">
                    <i class="fa fa-pencil" data-toggle="modal" href="#editModalMesas{{$mesa->id}}" title="Editar mesa"></i>
                  </a>
                  <a class="table-actions pocketMorado" href="#" onclick="eliminarMesa({{$mesa->id}})">
                    <i class="fa fa-trash-o" title="Eliminar mesa"></i>
                  </a>
                </td>
            	</tr>
              <div class="modal fade" id="editModalMesas{{$mesa->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
                      <button aria-hidden="true" class="close" data-dismiss="modal" type="button"  style="color:white">&times;</button>
                      <h4 class="modal-title">
                        Editar mesa
                      </h4>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="widget-content padded">
                          {!! Form::open() !!}
                            <fieldset>
                              <div class="row"> 
                                <div class="widget-content">
                                  <div class="form-group">
                                    <div class="form-group">
                                      <input type="text" id="nombreMesa{{$mesa->id}}" placeholder="Nombre" class="form-control" value="{{$mesa->nombreMesa}}" required="true" />
                                    </div>
                                    <div class="form-group">
                                      <select id="estadoMesa{{$mesa->id}}"  class="form-control">
                                        <option value="Disponible" <?php if($mesa->estado == "Disponible") echo "selected=''" ?> >Disponible</option>
                                        <option value="Ocupada"  <?php if($mesa->estado == "Ocupada") echo "selected=''" ?> >Ocupada</option>
                                        <option value="Reservada" <?php if($mesa->estado == "Reservada") echo "selected=''" ?> >Reservada</option>
                                      </select>
                                    </div>
                                  </div>  
                                </div>  
                              </div>
                            </fieldset>
                          {!! Form::close() !!} 
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-primary" data-dismiss="modal"  style="BACKGROUND-COLOR: rgb(79,0,85); color:white" onclick="modificarMesa({{$mesa->id}})">Guardar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach   
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  
  var routeModificarMesas = "http://localhost/PocketByR/public/mesas/modificar";
  var routeEliminarMesas = "http://localhost/PocketByR/public/mesas/eliminar";

  function modificarMesa(idMesa) {
    var nombre = $("#nombreMesa"+idMesa).val();
    var estado = $("#estadoMesa"+idMesa).val();
    $.ajax({
      url: routeModificarMesas,
      type: 'GET',
      data: {
        id: idMesa,
        nombre: nombre,
        estado: estado
      },
      success: function(){
        $("#mesa"+idMesa).children("td").each(function (indextd){
          if(indextd == 1){
            $(this).text(nombre);
          }else if(indextd == 2){
            $(this).text(estado);
          }
        });
      },
      error: function(data){
        alert("Error al modificar mesa");
      }
    });
  }

  function eliminarMesa(idMesa){
    if(confirm('¿Desea eliminar esta mesa?')){
      $.ajax({
        url: routeEliminarMesas,
        type: 'GET',
        data: {
          id: idMesa
        },
        success: function(){
          $("#mesa"+idMesa).remove();
        },
        error: function(data){
          alert('No se puede eliminar la mesa, debido a que se está utilizando.');
        }
      });
    }
  }

  $(".seleccionar").click(function(){
      var idElegido = $(this).attr("id");
      idElegido = idElegido.slice(4);
      var palabra = "#editModalMesas";
      var id = palabra.concat(idElegido);
      $(id).modal();
  });

  $("#dataTable2").dataTable();
  
</script>

<style type="text/css">

  #dataTable2.thead.tr.th{
    width: 800px;
  }
  
  .th.sorting_disabled{
    width: 800px;
  }
</style>

