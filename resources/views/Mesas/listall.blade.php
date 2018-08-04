<div class="row">
  <div class="col-sm-12">
    <div class="widget-container fluid-height clearfix">
      <div class="widget-content padded clearfix">
        <table style="width:100%;" class="table table-bordered table-striped" id="tablaMesas">
          <thead>
            <th  hidden="true"> </th>
            <th >Nombre</th>
            <th >Estado</th>
            <th id="opcionesMesas">Opciones</th>
          </thead>
          <tbody>
          	@foreach($mesas as $mesa)
            	<tr id="mesa{{$mesa->id}}">
                <td hidden="true"> </td>
            		<td id="mesa{{$mesa->id}}">{{$mesa->nombreMesa}}</td>
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
                <div class="modal-dialog modal-md" style="width: 50%;">
                  <div class="modal-content">
                    <div class="modal-header" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
                      <button aria-hidden="true" class="close" data-dismiss="modal" type="button"  style="color:white">&times;</button>
                      <h4 class="modal-title" style="font-weight: 400;font-size: 16px;">
                        Editar mesa
                      </h4>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="widget-content padded">
                          {!! Form::open() !!}
                            <fieldset>
                            <div class="widget-content">
                              <div class="row">
                                <div class="col-sm-12">
                                 <div class="col-sm-6">
                                 <!-- inicio de slider categoria-->
                                 <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                 <!-- Carousel indicators -->
                          		<!-- Wrapper for carousel items -->
                                  <div class="carousel-inner">
                                  <div class="item active">
                                  <img src="{{asset ('assets-Internas/images/SliderProfileCategoria/image-iso3.png')}}" alt="First Slide">
                                  </div>
                                  </div>
                                  <!-- Carousel controls -->
                                  </div>
                                  <!-- fin de slider categoria-->
                                  </div>
                                 <div class="col-sm-6 login-form">
                                   <p class="lead" style="margin-bottom: 10px;">Edita la <span class="text-success">Mesas</span></p>
                                    <ul class="list-unstyled" style="line-height: 1.5">
                                    <li><span class="fa fa-check text-success" style="padding-right:5px;"></span>Nombra la mesa a tu manera</li>
                                    <br>
                                    <div class="widget-content">
                                    <div class="form-group">
                                    <div class="input-container">
                                    <i class="glyphicon glyphicon-glass"></i>
                                     <input class="input" type="text" id="nombreMesa{{$mesa->id}}" placeholder="Nombre" value="{{$mesa->nombreMesa}}" required="true" />
                                    </div>
                                    <div class="input-container">
                                    <i class="glyphicon glyphicon-glass"></i>
                                    <select id="estadoMesa{{$mesa->id}}" style="width: 200px;"  class="select">
                                      <option value="Disponible" <?php if($mesa->estado == "Disponible") echo "selected=''" ?> >Disponible</option>
                                      <option value="Ocupada"  <?php if($mesa->estado == "Ocupada") echo "selected=''" ?> >Ocupada</option>
                                      <option value="Reservada" <?php if($mesa->estado == "Reservada") echo "selected=''" ?> >Reservada</option>
                                    </select>

                                    </div>

                                    </div>
                                    </div>
                                <div class="modal-footer">
                                  <button class="btn btn-primary" data-dismiss="modal"  style="BACKGROUND-COLOR: rgb(79,0,85); color:white" onclick="modificarMesa({{$mesa->id}})">Guardar</button>
                                </div>
                                </div>
                                </div>


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
<!-- asdfasfas-->



            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  var routeModificarMesas = "http://localhost/SmartBar/public/mesas/modificar";
  var routeEliminarMesas = "http://localhost/SmartBar/public/mesas/eliminar";

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

  $("#tablaMesas").DataTable( {
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
              }
          ]
      } );

</script>

<style type="text/css">

  #dataTable2.thead.tr.th{
    width: 100%;
  }

  .th.sorting_disabled{
    width: 100%;
  }
</style>
