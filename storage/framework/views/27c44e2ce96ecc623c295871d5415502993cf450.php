<script type="text/javascript">
    $(".mesaSeleccionada").click(function(){
    	var mesaElegida = $(this).attr("valor");
    	var idElegido = $(this).attr("name");
        document.getElementById("nombreMesa").value=mesaElegida;
        document.getElementById("idFactura").value=idElegido; 
        formulario.submit()
    });
</script>
 <form name="formulario" autocomplete="on" method="post" action="<?php echo e(url('bartender/pedido')); ?>">
 <?php echo e(csrf_field()); ?>

	<table id="tabla" class="table table-hover" border="2">
		<tbody>
			<?php foreach($mesas as $mesa): ?>
				<tr class="mesaSeleccionada" valor="<?php echo e($mesa->nombreMesa); ?>" name = "<?php echo e($mesa->idFactura); ?>">
				<td><?php echo e($mesa->nombreMesa); ?></td>
				<td  width=120>
					<?php
						$posiciones = explode(" ", $mesa->hora);
						$hora = explode(":", $posiciones[1]);
					?>
				<?php echo e($posiciones[0]); ?><br><?php echo e($hora[0]); ?>:<?php echo e($hora[1]); ?></td>
				</tr>	 
			<?php endforeach; ?>
		</tbody>
	</table>
	<input type="text" name="idFactura" id="idFactura"  required="" hidden="true">
	<input type="text" name="nombreMesa" id="nombreMesa"  required="" hidden="true">
	<input name="nombre" type="submit"  value="" hidden="true">
</form>
