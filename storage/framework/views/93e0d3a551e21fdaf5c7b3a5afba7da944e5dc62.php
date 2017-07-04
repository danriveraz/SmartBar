<?php $__env->startSection('content'); ?>
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel-tittle">
        <h1>Modificar categoría</h1>
    </div>
    <div class ="panel-body">
      <?php echo Form::open(['route' => ['auth.categoria.update',$categoria],  'method' => 'PUT']); ?>


        <div class="form-group">
          <label for="nombre" class="control-label">Nombre de la categoría</label>
          <input type="text" name="nombre" class="form-control" value="<?php echo e($categoria->nombre); ?>"/>
        </div>

        <br>
        <div class="form-grup">
          <br><button type="submit" class="btn btn-default" onclick = "return confirm ('¿Desea modificar esta categoría?')"><i class="fa fa-plus"></i> Editar categoría
          </button>
        </div>
      <?php echo Form::close(); ?>

  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>