<?php $__env->startSection('content'); ?>
<div class="col-sm-offset-2 col-sm-8">
	<div class="panel-tittle">
			<h1>Lista de facturas</h1>
	</div>

	<form class="navbar-form navbar-form" method="POST" action="<?php echo e(url('cajero/')); ?>">
	<?php echo e(csrf_field()); ?>

			<div class="navbar-text navbar-right">
					<input type="text" name="nombre" class="form-control" placeholder="Buscar">
					<button type="submit" class="btn btn-dufault">Buscar</button>
			</div>
			<div class="navbar-header">
				<b>Ver todas las facturas  &ensp;&ensp;</b>
				<input type="checkbox" name="verFacturas">
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
      <?php foreach($mesas as $mesa): ?>
      <form action="<?php echo e(url('cajero/recibo')); ?>" method="POST">
        <?php echo e(csrf_field()); ?>

      <tr class="mesaSeleccionada" valor="<?php echo e($mesa->nombreMesa); ?>" name = "<?php echo e($mesa->idFactura); ?>">
      	<td>
      		<?php echo e($mesa->nombreMesa); ?>

      	</td>
      	<td>
      		<?php echo e($mesa->fecha); ?>

      	</td>
      	<td>
      		<?php if($mesa->estado == 'En proceso'): ?>
      			<input type="text" name="id" value="<?php echo e($mesa->id); ?>" hidden=""h>
      			<button name="" class="btn btn-warning">
      				<span class="	glyphicon glyphicon-zoom-in"></span></a>
      			</button> 
      		<?php endif; ?>
          </td>
      </tr>
      </form>
      <?php endforeach; ?> 
    </tbody>
  </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>