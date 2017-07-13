<?php $__env->startSection('content'); ?>

<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle">
      <h1>Lista categorías</h1>
  </div>
  <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <a href="<?php echo e(route('categoria.create')); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Agregar nueva categoría </a>

  <table class="table table-hover">
    <thead>
      <th>#</th>
      <th>Nombre</th>
    </thead>
    <tbody>
      <?php foreach($categorias as $categoria): ?>
        <tr>
          <td><?php echo e($categoria->id); ?></td>
          <td><?php echo e($categoria->nombre); ?></td>

          <td><a href="<?php echo e(route('categoria.edit', $categoria->id)); ?>" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          <a href="<?php echo e(route('categoria.destroy', $categoria->id)); ?>" class="btn btn-default" style="BACKGROUND-COLOR: rgb(187,187,187); color:white"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
          </td>

        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>