@extends(Auth::User()->esAdmin ? 'Layout.app' : 'Layout.app_empleado');
@section('content')
<div class="col-sm-offset-2 col-sm-8">
	<div class="panel-tittle">
			<h1>Lista de facturas</h1>
	</div>
  <div>Ventas de la noche: $ <?php echo number_format($totalVentas,0,",","."); ?> </div>
  <br><br>
	<form class="navbar-form navbar-form" method="POST" action="{{url('cajero/')}}">
	{{csrf_field()}}
			<div class="navbar-text navbar-right">
					<input type="text" name="nombre" class="form-control" placeholder="Buscar">
					<button type="submit" class="btn btn-dufault">Buscar</button>
			</div>
			<div class="navbar-header">
				<b>Ver todas las facturas  &ensp;&ensp;</b>
				<label><input type="checkbox" name="verFacturas"><span></span></label>
			</div>
	</form>
</div>
<div class="col-sm-offset-2 col-sm-8">
	<table id="tabla" class="table table-hover">
    <thead>
      <th>Mesa</th>
      <th width="250">Fecha</th>
      <th width="20">Detalles</th>
    </thead>
    <tbody>
      @foreach($mesas as $mesa)
      <form action="{{url('cajero/recibo')}}" method="POST">
        {{csrf_field()}}
      <tr class="mesaSeleccionada" valor="{{$mesa->nombreMesa}}" nombre="{{$mesa->id}}">
      	<td>
      		{{$mesa->nombreMesa}}
      	</td>
      	<td>
      		{{$mesa->fecha}}
      	</td>
      	<td>
      			<input type="text" name="id" value="{{$mesa->id}}" hidden="">
      			<button name="" class="btn btn-warning" id="boton{{$mesa->id}}">
      				<span class="	glyphicon glyphicon-zoom-in"></span></a>
      			</button>  
          </td>
      </tr>
      </form>
      @endforeach 
    </tbody>
  </table>
</div>
<script type="text/javascript">
 $(document).ready(function(){
    cambiarCurrent("#cajero");
  });
function cambiarCurrent(idInput) {
  $(".current").removeClass("current");
  $(idInput).addClass("current");
};
$(".mesaSeleccionada").click(function(){
    var idElegido = $(this).attr("nombre");
    var palabra = "#boton";
    var id = palabra.concat(idElegido);
    alert(id);
    $(id).trigger('click');
});
</script>
@endsection