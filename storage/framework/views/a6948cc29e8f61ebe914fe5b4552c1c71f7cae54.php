<?php $__env->startSection('panel-title', 'insumo'); ?>
<?php $__env->startSection('content'); ?>

<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle">
      <h1>Lista de insumos</h1>
  </div>
  <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <a href="<?php echo e(route('insumo.create')); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Agregar nuevo insumo </a>
  <?php echo Form::model(Request::all(), ['route' => ['insumo.index'], 'method' => 'GET', 'class' => 'navbar-form navbar-right']); ?>

  <div class="form-group" align="right">
    <?php echo Form::text('nombre', null, ['class' => 'form-control', 'placelhoder' => 'Buscar', 'aria-describedby' => 'search']); ?>

    <button type="submit" class="btn btn-dufault">Buscar</button>
    <div align="right">
      <br>
      <?php echo Form::select('tipo', ['' => 'Seleccione un tipo','A la venta' => 'A la venta','No a la venta' => 'No a la venta'], null, ['class' => 'form-control']); ?>

    </div>
  </div>
  <?php echo Form::close(); ?>

  <table class="table table-hover">
    <thead>
      <th>#</th>
      <th>Nombre</th>
      <th>Proveedor</th>
      <th>Cantidad de unidades</th>
      <th>Valor de venta</th>
      <th>Valor de compra</th>
      <th>Cantidad de medida (oz)</th>
      <th>Tipo</th>
    </thead>
    <tbody>
      <?php foreach($insumos as $insumo): ?>
        <tr>
          <td><?php echo e($insumo->id); ?></td>
          <td><?php echo e($insumo->nombre); ?></td>
          <td><?php echo e($proveedores[$insumo->idProveedor]); ?></td>
          <td><?php echo e($insumo->cantidadUnidad); ?></td>
          <td><?php echo e($insumo->precioUnidad); ?></td>
          <td><?php echo e($insumo->valorCompra); ?></td>
          <td><?php echo e(number_format($insumo->cantidadMedida,3)); ?></td>
          <td><?php echo e($insumo->tipo); ?></td>
          <td><a href="<?php echo e(route('insumo.edit',$insumo->id)); ?>" class="btn btn-default" style="BACKGROUND-COLOR: rgb(79,0,85); color:white"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php echo $insumos->appends(Request::all())->render(); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>