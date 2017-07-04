<?php $__env->startSection('content'); ?>
<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle">
      <h1>Lista de usuarios</h1>
  </div>
  <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <a href="<?php echo e(route('auth.usuario.create')); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Agregar nuevo usuario </a>
  <table class="table table-hover">
    <thead>
      <th>#</th>
      <th>Nombre</th>
      <th>Numero de identificación</th>
      <th>Mesero</th>
      <th>Bartender</th>
      <th>Cajero</th>
      <th>Acción</th>
    </thead>
    <tbody>
      <?php foreach($usuarios as $usuario): ?>
        <tr>
          <td><?php echo e($usuario->id); ?></td>
          <td><?php echo e($usuario->nombre); ?></td>
          <td><?php echo e($usuario->numeroIdentificacion); ?></td>
          <td>
            <?php if($usuario->tipoMesero == 0): ?> No
            <?php else: ?> Si
            <?php endif; ?>
          </td>
          <td>
            <?php if($usuario->tipoBartender == 0): ?> No
            <?php else: ?> Si
            <?php endif; ?>
          </td>
          <td>
            <?php if($usuario->tipoCajero == 0): ?> No
            <?php else: ?> Si
            <?php endif; ?>
          </td>
          <td><a href="<?php echo e(route('auth.usuario.edit',$usuario->id)); ?>" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          <a href="<?php echo e(route('auth.usuario.destroy',$usuario->id)); ?>" onclick="return confirm('¿Estas seguro que deseas eliminar este usuario?')"
             class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php echo $usuarios->render(); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>