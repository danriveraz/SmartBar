<?php $__env->startSection('content'); ?>

<div class="col-sm-offset-3 col-sm-6">
  <div class="panel-tittle">
      <h1>Asignar insumos</h1>
  </div>
  <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <a href="<?php echo e(route('producto.index')); ?>" class="btn btn-default"><i class="fa fa-plus"></i>Guardar contenido</a>
  <div>
    <div>
      <div class="panel">
        <div class="panel-heading">
          <div class="panel-title">
            <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseOne">
              <div class="caret pull-right"></div>
              Insumos del producto</a>
          </div>
        </div>
        <div class="panel-collapse collapse" id="collapseOne">
          <div class="panel-body">
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
                  <td><a href="<?php echo e(route('contiene.destroy', $contiene->id)); ?>" class="btn btn-default"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div>
      <div>
        <h3>Insumos disponibles</h3>
      </div>
      <?php echo Form::model(Request::all(), ['route' => ['contiene.index'], 'method' => 'GET', 'class' => 'navbar-form navbar-right']); ?>

        <div class="form-group" align="right">
          <?php echo Form::text('nombre', null, ['class' => 'form-control', 'placelhoder' => 'Buscar', 'aria-describedby' => 'search']); ?>

          <button type="submit" class="btn btn-dufault">Buscar</button>
          <div align="right">
            <br>
            <?php echo Form::select('tipo', ['' => 'Seleccione un tipo','1' => 'A la venta','0' => 'No a la venta'], null, ['class' => 'form-control']); ?>

          </div>
        </div>
      <?php echo Form::close(); ?>

      <table class="table table-hover">
        <thead>
          <th>#</th>
          <th>Nombre</th>
          <th>Tipo</th>
          <th>Cantidad de onzas</th>
          <th align="right"><a href="<?php echo e(route('producto.index')); ?>" class="btn btn-default"><i class="fa fa-plus"></i>Adicionar insumos</a></th>
        </thead>
        <tbody>
          <?php foreach($insumosDisponibles as $insumo): ?>
          <tr>
            <form method="POST" action="<?php echo e(route('contiene.store',['idInsumo'=>$insumo->id])); ?>">
              <?php echo e(csrf_field()); ?>

              <td><?php echo e($insumo->id); ?></td>
              <td><?php echo e($insumo->nombre); ?></td>
              <td align="center">
                <input type="checkbox" disabled="disabled" name="tipo" id="tipo" <?php if($insumo->tipo == "1") echo "checked";?>/>
              </td>
              <td><input type="number" step="any" min="0" name="cantidad" class="form-control" value="<?php echo e($contador++); ?>"></td>
              <td align="center">
                <button type="submit" class="btn btn-dufault">
                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
              </td>
            </form>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php echo $insumosDisponibles->appends(Request::all())->render(); ?>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>