<script type="text/javascript">
    $(".mesaSeleccionada").click(function(){
    	var mesaElegida = $(this).attr("valor");
    	var idElegido = $(this).attr("name");
        document.getElementById("nombreMesa").value=mesaElegida;
        document.getElementById("idFactura").value=idElegido; 
        formulario.submit()
    });
</script>
 <form name="formulario" autocomplete="on" method="post" action="{{url('bartender/pedido')}}">
 {{csrf_field()}}
	<table id="tabla" class="table table-hover" border="2">
		<tbody>
			@foreach($mesas as $mesa)
				<tr class="mesaSeleccionada" valor="{{$mesa->nombreMesa}}" name = "{{$mesa->idFactura}}">
				<td>{{$mesa->nombreMesa}}</td>
				<td  width=120>
					<?php
						$posiciones = explode(" ", $mesa->hora);
						$hora = explode(":", $posiciones[1]);
					?>
				{{$posiciones[0]}}<br>{{$hora[0]}}:{{$hora[1]}}</td>
				</tr>	 
			@endforeach
		</tbody>
	</table>
	<input type="text" name="idFactura" id="idFactura"  required="" hidden="true">
	<input type="text" name="nombreMesa" id="nombreMesa"  required="" hidden="true">
	<input name="nombre" type="submit"  value="" hidden="true">
</form>
