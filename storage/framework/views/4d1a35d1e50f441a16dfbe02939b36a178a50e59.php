<?php $__env->startSection('content'); ?>

<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle">
    <h1>Lista de insumos</h1>
  <div>
    <h3>Insumos del producto</h3>
  </div>
  <div>
    <table class="table table-hover">
      <thead>
      <th></th>
      <th>Id insumo</th>
      <th>Cantidad de unidades (oz)</th>
    </thead>
    <tbody>
        <tr>
        </tr>
    </tbody>
  </table>
  </div>
  <br>
  <div>
    <h3>Insumos disponibles</h3>
  </div>
  <?php echo Form::model(Request::all(), ['route' => ['auth.contiene.create'], 'method' => 'GET', 'class' => 'navbar-form navbar-right']); ?>

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
      <th>Cantidad de unidades (oz)</th>
    </thead>
    <tbody>
      <?php foreach($insumos as $insumo): ?>
        <tr>
          <td><?php echo e($insumo->id); ?></td>
          <td><?php echo e($insumo->nombre); ?></td>
          <td>
            <div class="form-grup">
              <input type="number" value="0" name="cantidad" class="form-control">
            </div>
          </td>
          <td>
            <?php echo Form::model(Request::all(), ['route' => ['auth.contiene.store',$insumo->id], 'method' => 'GET', 'class' => 'navbar-form navbar-right']); ?>

            <button type="submit" class="btn btn-warning">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </button>
            <?php echo Form::close(); ?>

          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php echo $insumos->appends(Request::all())->render(); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>