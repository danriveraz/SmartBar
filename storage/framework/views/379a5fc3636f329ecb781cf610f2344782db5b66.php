<?php $__env->startSection('content'); ?>
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel-tittle">
        <h1>Lista de productos</h1>
    </div>
    <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <a href="<?php echo e(route('producto.create')); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Agregar nuevo producto </a>
    <?php echo Form::model(Request::all(), ['route' => ['producto.index'], 'method' => 'GET', 'class' => 'navbar-form navbar-right']); ?>

    <div class="form-group" align="right">
      <?php echo Form::text('nombre', null, ['class' => 'form-control', 'placelhoder' => 'Buscar', 'aria-describedby' => 'search']); ?>

      <button type="submit" style="BACKGROUND-COLOR: rgb(79,0,85); color:white" class="btn btn-dufault">Buscar</button>

    <div align="right">
      <br>
      <?php echo Form::select('categoria', $categorias, null, ['class' => 'form-control']); ?>

       <td><a href="<?php echo e(route('categoria.create')); ?>" class="btn btn-default" style="BACKGROUND-COLOR: rgb(187,187,187); color:white"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></td>
      <td><a href="<?php echo e(route('categoria.index')); ?>" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a></td>
    </div>
  </div>
  <?php echo Form::close(); ?>

  <table class="table table-hover">
    <thead>
      <th>#</th>
      <th>Nombre</th>
      <th>Precio</th>
      <th>Categoria</th>
    </thead>
    <tbody>
      <?php foreach($productos as $producto): ?>
        <tr>
          <td><?php echo e($producto->id); ?></td>
          <td><?php echo e($producto->nombre); ?></td>
          <td><?php echo e($producto->precio); ?></td>
          <td><?php echo e($categorias[$producto->idCategoria]); ?></td>
          <td><a href="<?php echo e(route('producto.edit',$producto->idProducto)); ?>" class="btn btn-warning"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php echo $productos->appends(Request::all())->render(); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>