<?php $__env->startSection('content'); ?>
<script type="text/javascript">
    $(".productoSeleccionado").click(function(){
      alert("sadfaf");
      var valor = $(this).attr("valor");
      var valorAntiguo = document.getElementById("precioAPagar").value;
      document.getElementById("precioAPagar").value = valor + valorAntiguo;
      formulario.submit()
    });
</script>    

<div class="col-sm-offset-3 col-sm-4">
	<div class="panel-tittle" align="center">
    <b><?php echo e($mesas[0]->nombreMesa); ?></b></div>
	</div>
  <div class="col-sm-offset-2 col-sm-7">
  <br><br>
	<table class="table table-hover">
    <thead>
      <th >Producto</th>
      <th width="50">Cantidad</th>
      <th width="110">Valor unitario</th>
      <th width="140">Valor Total</th>
      <th width="80">Pago</th>
    </thead>
    <tbody>
      <form action="<?php echo e(url('cajero/recibo')); ?>" method="POST">
        <?php foreach($elementos as $elemento): ?>
        <tr class="productoSeleccionado" valor="<?php echo e($elemento->precio*$elemento->cantidad); ?>">
          <td> <?php echo e($elemento->nombre); ?> </td>
          <td> <?php echo e($elemento->cantidad); ?> </td>
          <td> $ <?php echo number_format($elemento->precio,0,",","."); ?>  </td>
          <td> $ <?php echo number_format(($elemento->precio*$elemento->cantidad),0,",","."); ?>  </td>
          <td > <input type="checkbox" name="productos[]" value="<?php echo e($elemento->id); ?>"> </td>
        </tr>
        <?php endforeach; ?> 
        <tr>
          <td></td><td></td><td></td><td>Precio a pagar</td><td><p id="precioAPagar"></p></td>
        </tr>
        <tr>
          <td></td><td></td><td></td><td>Total</td><td><p id="Total"></p></td>
        </tr>
      </form>
    </tbody>
     <?php echo $elementos->appends(Request::all())->render(); ?>

  </table>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>