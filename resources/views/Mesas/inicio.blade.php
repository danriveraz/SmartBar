@extends('Layout.app')
@section('content')
<div class="col-sm-offset-2 col-sm-8">
	<div class="panel-tittle">
			<h1>Lista de facturas</h1>
	</div>

	<form class="navbar-form navbar-form" method="POST" action="{{url('mesas/')}}">
	{{csrf_field()}}
		<div class="navbar-text navbar-right">
				<input type="text" name="nombre" class="form-control" placeholder="Buscar">
				<button type="submit" class="btn btn-dufault">Buscar</button>
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
	<table id="tabla" class="table table-hover">
    <thead>
      <th>Mesa</th>
      <th width="250">Estado</th>
      <th width="20">Editar</th>
    </thead>
    <tbody>
      
	@foreach($mesas as $mesa)
    	<tr>
    		<td>{{$mesa->nombreMesa}}</td>
    		<td>{{$mesa->estado}}</td>
    		<td>
      			<button name="" class="btn btn-warning" data-toggle="modal" href="#myModal{{$mesa->id}}">
      			<span class="	glyphicon glyphicon-zoom-in"></span></a>
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
      <form name="formulario" autocomplete="on" method="post" action="{{url('mesas/edit')}}">
            {{csrf_field()}}
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
            Editar nombre: <input type="text" name="nombre" value="{{$mesa->nombreMesa}}">
            <input type="text" hidden="" name="id" value="{{$mesa->id}}">
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" style="BACKGROUND-COLOR: rgb(79,0,85); color:white">Guardar</button>
          <button class="btn btn-default-outline" data-dismiss="modal" type="button">Cerrar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endforeach 
<script>
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

</script>
@endsection