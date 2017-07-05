<?php $__env->startSection('content'); ?>
    
<div class="col-sm-offset-3 col-sm-4">
	<div class="panel-tittle" align="center">
    <b><?php echo e($mesas[0]->nombreMesa); ?></b></div>
	</div>
  <div class="col-sm-offset-2 col-sm-7">
	<table class="table table-hover">
    <thead>
      <th >Producto</th>
      <th width="50">Cantidad</th>
      <th width="110">Valor unitario</th>
      <th width="100">Valor Total</th>
    </thead>
    <tbody>
      <form action="<?php echo e(url('cajero/recibo')); ?>" method="POST">
        <?php foreach($elementos as $elemento): ?>
        <tr>
          <td> <?php echo e($elemento->nombre); ?> </td>
        </tr>
        <?php endforeach; ?> 
      </form>
    </tbody>
     <?php echo $elementos->appends(Request::all())->render(); ?>

  </table>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>