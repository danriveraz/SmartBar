<?php $__env->startSection('content'); ?>

<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle">
      <h1>Asignar insumos</h1>
  </div>
  <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <a href="<?php echo e(route('auth.contiene.create', ['idProducto'=>$idProducto])); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Ingresar nuevo insumo </a>
  <table class="table table-hover">
    <thead>
      <th>#</th>
      <th>Insumo</th>
      <th>Cantidad de onzas</th>
    </thead>
    <tbody>
      <?php foreach($contienen as $contiene): ?>
        <tr>
          <td><?php echo e($contiene->idInsumo); ?></td>
          <td><?php echo e($insumos[$contiene->idInsumo]); ?></td>
          <td><?php echo e($contiene->cantidad); ?></td>
          <td><a href="" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>