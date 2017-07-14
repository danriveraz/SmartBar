<?php $__env->startSection('content'); ?>

<div class="col-sm-offset-2 col-sm-8">
  <div class="panel-tittle">
      <h1>Lista de proveedores</h1>
  </div>
  <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <a href="<?php echo e(route('proveedor.create')); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Agregar nuevo proveedor </a>
  <?php echo Form::model(Request::all(), ['route' => ['proveedor.index'], 'method' => 'GET', 'class' => 'navbar-form navbar-right']); ?>

  <div class="form-group" align="right">
    <?php echo Form::text('nombre', null, ['class' => 'form-control', 'placelhoder' => 'Buscar', 'aria-describedby' => 'search']); ?>

   <button type="submit" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" class="btn btn-dufault">Buscar</button>
  </div>
  <?php echo Form::close(); ?>

  <table class="table table-striped">
    <thead>
      <th>#</th>
      <th>Nombre</th>
      <th>Dirección</th>
      <th>Telefono</th>
    </thead>
    <tbody>
      <?php foreach($proveedores as $proveedor): ?>
        <tr>
          <td><?php echo e($proveedor->id); ?></td>
          <td><?php echo e($proveedor->nombre); ?></td>
          <td><?php echo e($proveedor->direccion); ?></td>
          <td><?php echo e($proveedor->telefono); ?></td>
          <td align="right"><a href="<?php echo e(route('proveedor.edit',$proveedor->id)); ?>" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          <a href="<?php echo e(route('proveedor.destroy', $proveedor->id)); ?>" class="btn btn-default" onclick = "return confirm ('¿Desea eliminar este proveedor?')" style="BACKGROUND-COLOR: rgb(187,187,187); color:white"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>

          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php echo $proveedores->appends(Request::all())->render(); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>