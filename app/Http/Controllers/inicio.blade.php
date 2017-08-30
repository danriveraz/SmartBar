@extends('Layout.app')
@section('content')
<div class="col-sm-offset-2 col-sm-8">
<div class="panel-tittle" align="center">
      <h3>ESTADOS MESAS</h3>
  </div>
	<form class="navbar-form navbar-form" method="POST" action="{{url('mesas/')}}">
	{{csrf_field()}}
		<div class="navbar-text navbar-right">
				<input type="text" name="nombre" class="form-control" placeholder="Buscar">
		</div>
	</form>
	<form class="navbar-form navbar-form" method="POST" action="{{url('mesas/create')}}">
	{{csrf_field()}}
		<div class="navbar-header">
			<input type="number" name="cantidad" min="0" placeholder="Cantidad" style="width:80px;" class="cantidadSeleccionada" max="100" id="cantidad" onkeyup="validarMinMax('#cantidad');" value="0">
			<button type="submit" class="btn btn-dufault">Crear automaticamente</button>
		</div>
	</form>
	
</div>
<div class="col-sm-offset-2 col-sm-8">
	<table id="tabla" class="table table-striped">
    <thead>
      <th></th>
      <th></th>
      <th width="20"></th>
      <th width="20"></th>
    </thead>
    <tbody>
      
	@foreach($mesas as $mesa)
    	<tr id="{{$mesa->id}}">
    		<td>{{$mesa->nombreMesa}}</td>
    		<td>{{$mesa->estado}}</td>
    		<td>
      			<button name="" class="btn btn-default" data-toggle="modal" href="#myModal{{$mesa->id}}" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">
      			<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
      			</button> 
    		</td>
        <td>
          <button class="btn btn-default" onclick="eliminar({{$mesa->id}});" style="BACKGROUND-COLOR: rgb(187,187,187); color:white">
          <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
          </button>
        </td>
    	</tr>
    @endforeach 

    </tbody>
  </table>
</div>
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
                    <select id="estado{{$mesa->id}}"  class="form-control" value="{{$mesa->estado}}">
                      <option value="Disponible">Disponible</option>
                      <option value="Ocupada">Ocupada</option>
                      <option value="Reservada">Reservada</option>
                    </select>
                </div>
              </div>  
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" onclick="modificar({{$mesa->id}});" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" >Guardar</button>
          <button class="btn btn-default-outline" data-dismiss="modal" type="button">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
@endforeach 
<script>
$(document).ready(function(){

    cambiarCurrent("#mesas");
});
function validarMinMax(idInput) {
    var valor = parseInt($(idInput).val());
    var max = parseInt($(idInput).attr("max"));
    if(valor > max) {
        $(idInput).val(max);
    } 
    if (valor < 0){
        $(idInput).val(0);
    }
};
function cambiarCurrent(idInput) {
  $(".current").removeClass("current");
  $(idInput).addClass("current");
};


var routeEliminar = "http://pocketdesigner.co/PocketByR/public/mesas/eliminar";
var routeModificar = "http://pocketdesigner.co/PocketByR/public/mesas/edit";
function eliminar(idMesa){
      if(confirm('¿Desea eliminar este proveedor?')){
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
      alert(nombre + " "+ estado);
      $.ajax({
        url: routeModificar,
        type: 'GET',
        data: {
          id: idMesa,
          nombre: nombre,
          estado: estado
        },
        success: function(data){
          alert("modifique");
        },
        error: function(data){
          alert("Error al modificar mesa.");
        }
      });
    }
</script>
@endsection